<?php
use Illuminate\Support\Facades\DB;

function getcategory()
{
	return DB::table('categories')
		->where([['status', '=' , '1']])
		->orderBy('name')->get();
}

function getproduct()
{
	return DB::table('products')
	    ->where([['status','=','1']])
		 ->orderBy('name')->get();
}

function getcategoryslug()
{
    return DB::table('categories')->get();
}

function getCategoryDetail($id)
{
	return DB::table('categories')->where('id',$id)->first();
}

function getProductDetail($id)
{
	return DB::table('products')->where('id',$id)->first();
}

function getQoutDetail($id)
{
	return DB::table('qoutations')->where([['id', '=' , $id]])->get()->toArray();
}

function getItemsCount($cat)
{
	return DB::table('items')->where("cat_code",$cat)->count();
}

function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}

function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees Only' : '') ;
}

function setcart($id)
{
    $datacol = getQoutDetail($id);
    $sno = 0;
    $cart= array();
    $data = $datacol[0];
    $items = json_decode($data->data);
    $count = count((array)$items->id);
    for($i=0;$i<$count;$i++)
    {
        $item = array('sno'=>$sno,
	'id'=>$items->id[$i],
	'pic'=>$items->pic[$i],
	'item'=>$items->perticular[$i],
	'Qty'=>$items->qty[$i],
	'price'=>$items->price[$i],
	'disc'=>$items->disc[$i],
	'gst'=>$items->gst[$i],
	'remark'=>$items->remarks[$i]);
    array_push($cart,$item);
    $sno++;
    }
    $editarr = array(true,$id);
    session(['cart' => $cart]);
    session(['editqout' => $editarr]);

}

function getItemDetail($id)
{
	return DB::table('items')->where([['id', '=' , $id]])->first();
}

function getItemsDetailsList($id,$cat)
{
	return DB::table('item_detail')->where([['cat_code', '=' , $cat],['item_code','=',$id]])->orderBy('variant')->orderBy('cost')->get();
}

function getsizeList($id,$cat)
{
	return DB::table('item_detail')->where([['cat_code', '=' , $cat],['item_code','=',$id]])->groupBy('size')->get();
}

function getsizevarname($id)
{
	$item =  DB::table('item_detail')->where([['id','=',$id]])->first();
    return $item->size.' | '.$item->variant;

}

function checkitemcode($cc,$ic)
{
   return DB::table('items')->where([['cat_code', '=' , $cc],['item_code','=',$ic]])->first();
}

function getvariantList($id,$cat)
{
	return DB::table('item_detail')->where([['cat_code', '=' , $cat],['item_code','=',$id]])->groupBy('variant')->get();
}

function getpricesv($s,$v,$ic,$cat)
{
    return DB::table('item_detail')->where([['size', '=' , $s],['variant','=',$v],['item_code', '=' , $ic],['cat_code','=',$cat]])->first();

}

function getcurrstock($id)
{
    $var = DB::table('item_detail')->where([['id', '=' , $id]])->first();
    return $var->stock;
}

function getcodedata($code)
{
    $result = array();
		$code = trim($code);
		if(strlen($code)<=1)
		{
			return redirect(url()->previous())->with('message', 'Error');
		}
		$spl = "0";
		if(is_numeric($code[1]))
		{
		$cat_v = $code[0];
		$cat = getcategoryid($cat_v);
		$ic = trim($code,$cat_v);
		$id = getItemid($ic,$cat);
		//echo $ic;
		array_push($result,$spl);
		array_push($result,$id);
		array_push($result,$code);
		}
		else
		{
		$cat_v = $code[0].$code[1];
		$cat = getcategoryid($cat_v);
		$ic = trim($code,$cat_v);
		$id = getItemid($ic,$cat);
		//echo $ic;
		array_push($result,$spl);
		array_push($result,$id);
		array_push($result,$code);
		}
        return $result;
}

function getsizes($cat,$id)
{
    $result = array();
    $sizes = array();
    $variants = array();
    foreach (getvariantList($id,$cat) as $s) {
        array_push($sizes, $s->variant);
    }
    foreach (getsizeList($id,$cat) as $v) {
        $var = array();
        array_push($var,$v->size);
        foreach($sizes as $size)
        {

            $item = DB::table('items')->where([['cat_code', '=' , $cat],['item_code','=',$id]])->first();

            $cost = getpricesv($v->size,$size,$id,$cat)!=null ? getpricesv($v->size,$size,$id,$cat)->cost : 0;
			$mrp = getpricesv($v->size,$size,$id,$cat)->mrp ?? 0;
            $sp = getprice(getsellprice($mrp,$cost,$item->import,$id,$cat),0);
            array_push($var, $sp);
        }
        array_push($variants, $var);
    }
    $result['variant'] =$variants;
    $result['sizes'] = $sizes;
    return $result;
}

function getDealersList($cat)
{
	return DB::table('dealers')->where([['cat_code', '=' , $cat]])->orderBy('id')->get();
}
function getdealers($cc,$ic)
{
	return DB::table('dealers')->where([['cat_code', '=' , $cc],['item_code','=',$ic]])->orderBy('id')->get();
}

function getdealersfirst($cc,$ic)
{
	return DB::table('dealers')->where([['cat_code', '=' , $cc],['item_code','=',$ic]])->orderBy('id')->first();
}

function multi_in_array($needle, $haystack, $key) {
    foreach ($haystack as $h) {
        if (array_key_exists($key, $h) && $h[$key]==$needle) {
            return true;
        }
    }
    return false;
}

function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['sno'] === $id) {
           return $key;
       }
   }
   return null;
}

function getcatlogslist()
{
	$qouts = DB::table('catlogs')->orderBy('id','desc')->get();
	return $qouts;
}

function deletecatlogs($id)
{
	return DB::table('catlogs')->where('id',$id)->delete();

}

function calculate($qty,$price,$disc,$gst)
{
    $a1 = $qty * $price;
    $a2 = $a1 - ($a1*($disc/100));
    $a3 = $a2 + ($a2*($gst/100));
    $amt =  round($a3);
    return $amt;
}

function calculatetotal()
{
    $c = count(session('cart'),0);
    $amount = 0;
	foreach(session('cart') as $item)
	{
		$amt = calculate($item['Qty'],$item['price'],$item['disc'],$item['gst']);
		$amount += $amt;
	}
    return $amount;

}

function addDummyCart()
    {
    $sno = 0;
    $cart= array();
	if(session('cart')!=null)
	{
		$cart = session('cart');
		$sno = count($cart, 0);
	}
	$item = array('sno'=>$sno,
	'id'=>'0',
	'pic'=>'default.jpg',
	'item'=>'',
	'Qty'=>0,
	'price'=>0,
	'disc'=>0,
	'gst'=>18,
	'remark'=>'');

	array_push($cart,$item);
    session(['cart' => $cart]);
    }


function addcart($id,$qty,$finish)
{
	$variant = getVariantDetails($id);
	$itemdetails = DB::table('items')->where([['item_code','=',$variant->item_code],['cat_code','=',$variant->cat_code]])->first();

	$cart= array();
	$item = array('pic'=>$itemdetails->pic,'item_code'=>$variant->item_code);
	if(session('cart')!=null)
	{
		$cart = session('cart');
	}

array_push($cart,$item);
	session(['cart' => $cart]);
	//dd(session('cart'));
	return true;
}

function getVariantDetails($id)
{
	return DB::table('item_detail')->where([['id', '=' , $id]])->first();
}

function search($key)
{
	$data = DB::table('dealers')
			->join('items',function($join)
			{
				$join->on('items.item_code', '=', 'dealers.item_code');
				$join->on('items.cat_code', '=', 'dealers.cat_code');
			})
            ->join('item_detail',function($join)
			{
				$join->on('item_detail.item_code', '=', 'dealers.item_code');
				$join->on('item_detail.cat_code', '=', 'dealers.cat_code');
			})
			->where('model', 'like', '%' . $key . '%')
			->orwhere('company', 'like', '%' . $key . '%')
			->orwhere('dealer', 'like', '%' . $key . '%')
			->orwhere('finish', 'like', '%' . $key . '%')
            ->orwhere('variant', 'like', '%' . $key . '%')
            ->orwhere('size', 'like', '%' . $key . '%')
			->get();
            //dd($data);
	return $data;
}

function getsearchpic($ic, $cc ,$vid)
{
	$iid =getItemid($ic, $cc);
	$itemdetail = getItemDetail($iid);
	$variantdetail = getVariantDetails($vid);
	$pic = $variantdetail->pic;
	if($pic=="default.jpg")
	{
		$pic = $itemdetail->pic;
	}
	return $pic;
}

function createcode($ic,$cc)
  {
	  $catcode = getcategorystart($cc);
	  return $catcode.$ic;
  }

function getfreenum($from, $to, $cat)
{
	$list = array();
	for($i=$from;$i<=$to;$i++)
	{
		if(getItemid($i,$cat)==0)
		{
			array_push($list,$i);
		}
	}
	return $list;
}

function getdealerlist()
{
	$dealer = DB::table('dealers')->groupBy('dealer')->orderBy('dealer')->get();
	return $dealer;
}

function catlogcheck($id)
{

    if(session('catlog')!=null)
	{
        $catlog = session('catlog');
        return in_array($id,$catlog);
	}
    return false;
}

function getcompanylist()
{
	$dealer = DB::table('dealers')->groupBy('company')->orderBy('company')->get();
	return $dealer;
}

function getqoutationslist()
{
	$qouts = DB::table('qoutations')->orderBy('id','desc')->get();
	return $qouts;
}


function getRatecode()
{
	return DB::table('rate_code')->orderBy('id')->get();
}

function getSettings()
{
	return DB::table('settings')->orderBy('id')->get();
}

function getItemsList($id)
{
	return DB::table('items')->where([['cat_code', '=' , $id]])->orderBy('item_code')->get();
}



function deletevariants($cc,$ic)
{
	return DB::table('item_detail')->where([['cat_code', '=' , $cc],['item_code','=',$ic]])->delete();
}

function deletedealers($cc,$ic)
{
	return DB::table('dealers')->where([['cat_code', '=' , $cc],['item_code','=',$ic]])->delete();
}

function deletecategory($id)
{
	// return DB::table('categories')->where('id',$id)->delete();
	$cat = Category::find($id);
	$cat->delete();

}

function deleteqout($id)
{
	return DB::table('qoutations')->where('id',$id)->delete();

}

function deleteitem($id)
{
	return DB::table('items')->where('id',$id)->delete();

}

function deletedealer($id)
{
	return DB::table('dealers')->where('id',$id)->delete();

}



function deletevariant($id)
{
	return DB::table('item_detail')->where('id',$id)->delete();

}

function edititem($id)
{
	return DB::table('items')->where('id',$id)->get();

}

function getcategoryname($id)
{
	$var = DB::table('categories')->where('id',$id)->first();
	return $var->name;

}

function getcategoryid($id)
{
	$var = DB::table('categories')->where('start',$id)->first();
	return isset($var->id) ? $var->id : "";

}

function getcategorystart($id)
{
	$var = DB::table('categories')->where('id',$id)->first();
	return $var->start;

}

function setimages()
	{
		$result = array("H1038","H105","H106","H1063","H1064","H1065","H1086","H1087","H1088","H1091","H1092",
		"H1104","H1112","H1113","H1135","H1158","H1159","H1160","H1161","H1162","H1164","H1165","H1169","H1173",
		"H1194","H1201","H1202","H1203","H1206","H1216","H1217","H1222","H1223","H1224","H1225","H1230","H1231",
		"H1232","H1233","H1234","H1235","H1239","H1240","H1241","H1242","H1243","H1244","H1245","H1248","H1249",
		"H1250","H1251","H1255","H1259","H1263","H1264","H1270","H1272","H1273","H1292","H1294","H1295","H1296",
		"H1297","H1304","H1310","H1311","H1322","H1323","H1324","H1325","H1326","H1327","H1329","H1330","H1331",
		"H1332","H1333","H1334","H1338","H1339","H1340","H1341","H1342","H1344","H1345","H1346","H1347","H1348",
		"H1349","H1350","H1351","H1352","H1353","H1354","H1355","H1356","H1357","H1358","H1359","H177","H184",
		"H214","H217","H257","H261","H291","H304","H333","H367","H379","H401","H415","H416","H418","H420","H421",
		"H430","H431","H463","H469","H477","H497","H498","H500","H504","H531","H532","H538","H543","H553","H570",
		"H577","H588","H59","H60","H627","H628","H638","H642","H643","H644","H668","H716","H717","H718","H719","H720",
		"H721","H833","H853","H854","H855","H91","K1032","K1037","K1038","K1039","K1041","K1042","K1048","K1054","K1055",
		"K1056","K1057","K1061","K1062","K1063","K1065","K1066","K1067","K1068","K1069","K1071","K1072","K1073","K1074",
		"K1075","K1076","K1077","K1078","K1079","K1080","K1081","K1082","K1083","K1084","K1085","K1086","K1087","K1088",
		"K1090","K1091","K1092","K1093","K1094","K1096","K1098","K1103","K1107","K1108","K1110","K1111","K1112","K1113",
		"K1114","K1115","K1116","K1117","K1118","K1119","K1120","K1122","K1123","K1124","K117","K119","K120","K200","K205",
		"K211","K238","K239","K252","K253","K254","K255","K256","K257","K258","K261","K262","K263","K264","K269","K270","K272",
		"K28","K300","K303","K313","K314","K316","K318","K319","K320","K321","K323","K328","K329","K330","K331","K333","K334",
		"K335","K336","K337","K55","K57","K58","K63","K65","K66");
		$val = array();
		for($i=0;$i<count($result)-1;$i++)
		{
		$code = $result[$i];
		$cat_v = $code[0];
		$cat = getcategoryid($cat_v);
		$ic = trim($code,$cat_v);
		$id = getItemid($ic,$cat);
		try{
			DB::table('items')
			->where([['item_code','=',$ic],['cat_code','=',$cat]])
			->Update([
			'pic'=>$code.".JPG"
		]);
			//return redirect('/home');
			}
			catch(Exception $e) {
				//return redirect('/home');
				}
		}

		dd($val);
	}

function compressImage($source, $destination, $quality) {

	$info = getimagesize($source);

	if ($info['mime'] == 'image/jpeg')
	  $image = imagecreatefromjpeg($source);

	elseif ($info['mime'] == 'image/gif')
	  $image = imagecreatefromgif($source);

	elseif ($info['mime'] == 'image/png')
	  $image = imagecreatefrompng($source);

	imagejpeg($image, $destination, $quality);

  }

function getItemid($ic,$cc)
{
	//echo $ic."<br>".$cc;
	$var = DB::table('items')->where([['item_code','=',$ic],['cat_code','=',$cc]])->first();
	return (isset($var->id)) ? $var->id : 0;

}

function getprice($val, $per)
{
	$val = doubleval($val);
	$per = doubleval($per);
	$res = $val + (($val)*($per/100));
	return round($res);
}

/*function getprice($val, $per)
{
	$val = doubleval($val);
	$per = doubleval($per);
	$res = $val + (($val)*($per/100));
	return round($res);
}*/


function encodeprice($id)
{
	$price_array = str_split($id,1);
	$code_array = array();
	if(isset(getcode('12')->To)&&getcode('12')->To!="")
	{
		array_push($code_array,getcode('12')->To);
	}
	for($i=0;$i<count($price_array);$i++)
	{

		if(isset($price_array[$i+1]) && $price_array[$i]==$price_array[$i+1])
		{
			array_push($code_array,getcode($price_array[$i])->To);
			array_push($code_array,getcode('11')->To);
			$i++;
		}
		else{
			array_push($code_array,getcode($price_array[$i])->To);
		}
	}
	if(isset(getcode('13')->To)&&getcode('13')->To!="")
	{
		array_push($code_array,getcode('13')->To);
	}
	$lp = implode("",$code_array);
	return $lp;
}

function getcode($id)
{
	return DB::table('rate_code')->where('val',$id)->first();
}

function getsellprice($mrp,$cp,$type,$ic,$cc)
{
	if($type == 'S')
	{
		$mul = DB::table('items')->where([['item_code','=',$ic],['cat_code','=',$cc]])->first();
		return $cp*$mul->s_price;
	}
	if($type == 'MRP')
	{
		return $mrp;
	}
	else{
		return $cp*getmultiplier($type)->value;
	}
}

function getmultiplier($id)
{
	return DB::table('settings')->where('name',$id)->first();
}

function getURSum($id, $type_id)
{
	return DB::table('transactions')
		->where([['receiver_id', '=' , $id],['type_id', '=' , $type_id]])
		->sum('amount');
}

function getUGCount($id, $type_id)
{
	return DB::table('transactions')
		->where([['sender_id', '=' , $id],['type_id', '=' , $type_id]])
		->count();
}

function getUGSum($id, $type_id)
{
	return DB::table('transactions')
		->where([['sender_id', '=' , $id],['type_id', '=' , $type_id]])
		->sum('amount');
}

function getAllMembers()
{
	return DB::table('users')->where([['id', '!=' , auth()->id()],['status','=','1']])->orderBy('name')->get();
}

function getAllMemberslist()
{
	return DB::table('users')->where([['status','=','1']])->orderBy('name')->get();
}

function getMemberDetail($id)
{
	return DB::table('users')->where('id',$id)->first();
}

function getBioDetail($id)
{
	return DB::table('memberdetails')->where('user_id',$id)->first();
}

function getVisitorName($id)
{
	return DB::table('visitors')->where('id',$id)->first();
}

function deletereferal($id)
{
	DB::table('referals')->where('id',$id)->delete();
	return DB::table('transactions')->where('referal_id',$id)->delete();
}



function deletethankyounote($id)
{
	DB::table('thankyounotes')->where('id',$id)->delete();
	return DB::table('transactions')->where('thankyou_id',$id)->delete();
}

function deletevisitor($id)
{
	DB::table('visitors')->where('id',$id)->delete();
	return DB::table('transactions')->where('visitor_id',$id)->delete();
}

function deletebm($id)
{
	DB::table('businesmeets')->where('id',$id)->delete();
	return DB::table('transactions')->where('businessmeet_id',$id)->delete();
}

function deletetestimonial($id)
{
	DB::table('testimonials')->where('id',$id)->delete();
	return DB::table('transactions')->where('testimonial_id',$id)->delete();
}

function getMemberDetailBio($id)
{
	return DB::table('memberdetails')->where('id',$id)->first();
}

function getReferalReceived($id)
{
	return DB::table('referals')->where('receiver_id',$id)->get();
}

function getReferalGiven($id)
{
	return DB::table('referals')->where('sender_id',$id)->get();
}

function getThankyouNoteReceived($id)
{
	return DB::table('thankyounotes')->where('receiver_id',$id)->get();
}

function getThankyouNoteGiven($id)
{
	return DB::table('thankyounotes')->where('sender_id',$id)->get();
}

function getTestimonialReceived($id)
{
	return DB::table('testimonials')->where('receiver_id',$id)->get();
}

function getTestimonialeGiven($id)
{
	return DB::table('testimonials')->where('sender_id',$id)->get();
}

function getbusinessmeetsGiven($id)
{
	return DB::table('businesmeets')->where('sender_id',$id)->get();
}

function getvisitorsGiven($id)
{
	return DB::table('visitors')->where('sender_id',$id)->get();
}

function getnotificationlist($id)
{
	return DB::table('transactions')
	->where([['receiver_id','=',$id],['read_status','=','1']])->get();
}

function getnotificationcount($id)
{
	return DB::table('transactions')
	->where([['receiver_id','=',$id],['read_status','=','1']])->count();
}
function clearnotifications($id)
{
	return DB::table('transactions')
	->where('receiver_id',$id)
	->update(['read_status' => '0']);
}
function resetpassword($id)
{
	return DB::table('users')
	->where('id',$id)
	->update(['password' => '$2y$10$tOZJyU4b31geErVlkmf2kuw0N.invUkJk9Z4dKU8zzGuOfXQy5f/y','pass_changed' => '0']);
}

function deleteuser($id)
{
	if(auth()->id()==$id)
	{
		return "You Cannot delete Self account";
	}
	$var = DB::table('users')->where('id',$id)->delete();
	if($var)
	{
		return "Successfully Deleted";
	}
	return "Ërror Dealting User";
}

?>