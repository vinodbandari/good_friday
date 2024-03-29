(() => {
    function s(n) {
        var r = o[n];
        return void 0 === r ? (r = o[n] = {
            exports: {}
        }, t[n].call(r.exports, r, r.exports, s), r.exports) : r.exports
    }
    var t = {
            105: () => {
                ! function(c) {
                    function e(t, n) {
                        this.options = n, this.$elementFilestyle = [], this.$element = c(t)
                    }
                    var o = 0;
                    e.prototype = {
                        clear: function() {
                            this.$element.val(""), this.$elementFilestyle.find(":text").val(""), this.$elementFilestyle.find(".badge").remove()
                        },
                        destroy: function() {
                            this.$element.removeAttr("style").removeData("filestyle"), this.$elementFilestyle.remove()
                        },
                        disabled: function(e) {
                            if (!0 === e) this.options.disabled || (this.$element.attr("disabled", "true"), this.$elementFilestyle.find("label").attr("disabled", "true"), this.options.disabled = !0);
                            else {
                                if (!1 !== e) return this.options.disabled;
                                this.options.disabled && (this.$element.removeAttr("disabled"), this.$elementFilestyle.find("label").removeAttr("disabled"), this.options.disabled = !1)
                            }
                        },
                        buttonBefore: function(e) {
                            if (!0 === e) this.options.buttonBefore || (this.options.buttonBefore = !0, this.options.input && (this.$elementFilestyle.remove(), this.constructor(), this.pushNameFiles()));
                            else {
                                if (!1 !== e) return this.options.buttonBefore;
                                this.options.buttonBefore && (this.options.buttonBefore = !1, this.options.input && (this.$elementFilestyle.remove(), this.constructor(), this.pushNameFiles()))
                            }
                        },
                        icon: function(e) {
                            if (!0 === e) this.options.icon || (this.options.icon = !0, this.$elementFilestyle.find("label").prepend(this.htmlIcon()));
                            else {
                                if (!1 !== e) return this.options.icon;
                                this.options.icon && (this.options.icon = !1, this.$elementFilestyle.find(".icon-span-filestyle").remove())
                            }
                        },
                        input: function(e) {
                            if (!0 === e) this.options.input || (this.options.input = !0, this.options.buttonBefore ? this.$elementFilestyle.append(this.htmlInput()) : this.$elementFilestyle.prepend(this.htmlInput()), this.$elementFilestyle.find(".badge").remove(), this.pushNameFiles(), this.$elementFilestyle.find(".group-span-filestyle").addClass("input-group-btn"));
                            else {
                                if (!1 !== e) return this.options.input;
                                this.options.input && (this.options.input = !1, this.$elementFilestyle.find(":text").remove(), 0 < (e = this.pushNameFiles()).length && this.options.badge && this.$elementFilestyle.find("label").append(" <span class=\"badge\">" + e.length + "</span>"), this.$elementFilestyle.find(".group-span-filestyle").removeClass("input-group-btn"))
                            }
                        },
                        size: function(n) {
                            if (void 0 === n) return this.options.size;
                            var o = this.$elementFilestyle.find("label"),
                                e = this.$elementFilestyle.find("input");
                            o.removeClass("btn-lg btn-sm"), e.removeClass("input-lg input-sm"), "nr" != n && (o.addClass("btn-" + n), e.addClass("input-" + n))
                        },
                        placeholder: function(e) {
                            return void 0 === e ? this.options.placeholder : void(this.options.placeholder = e, this.$elementFilestyle.find("input").attr("placeholder", e))
                        },
                        buttonText: function(e) {
                            return void 0 === e ? this.options.buttonText : void(this.options.buttonText = e, this.$elementFilestyle.find("label .buttonText").html(this.options.buttonText))
                        },
                        buttonName: function(e) {
                            return void 0 === e ? this.options.buttonName : void(this.options.buttonName = e, this.$elementFilestyle.find("label").attr({
                                class: "btn " + this.options.buttonName
                            }))
                        },
                        iconName: function(e) {
                            return void 0 === e ? this.options.iconName : void this.$elementFilestyle.find(".icon-span-filestyle").attr({
                                class: "icon-span-filestyle " + this.options.iconName
                            })
                        },
                        htmlIcon: function() {
                            return this.options.icon ? "<span class=\"icon-span-filestyle " + this.options.iconName + "\"></span> " : ""
                        },
                        htmlInput: function() {
                            return this.options.input ? "<input type=\"text\" class=\"form-control " + ("nr" == this.options.size ? "" : "input-" + this.options.size) + "\" placeholder=\"" + this.options.placeholder + "\" disabled> " : ""
                        },
                        pushNameFiles: function() {
                            var e = "",
                                t = [];
                            void 0 === this.$element[0].files ? t[0] = {
                                name: this.$element[0] && this.$element[0].value
                            } : t = this.$element[0].files;
                            for (var n = 0; n < t.length; n++) e += t[n].name.split("\\").pop() + ", ";
                            return "" == e ? this.$elementFilestyle.find(":text").val("") : this.$elementFilestyle.find(":text").val(e.replace(/\, $/g, "")), t
                        },
                        constructor: function() {
                            var e = this,
                                t = e.$element.attr("id"),
                                r, i;
                            "" !== t && t || (e.$element.attr({
                                id: t = "filestyle-" + o
                            }), o++), i = "<span class=\"group-span-filestyle " + (e.options.input ? "input-group-btn" : "") + "\"><label for=\"" + t + "\" class=\"btn " + e.options.buttonName + " " + ("nr" == e.options.size ? "" : "btn-" + e.options.size) + "\" " + (e.options.disabled ? "disabled=\"true\"" : "") + ">" + e.htmlIcon() + "<span class=\"buttonText\">" + e.options.buttonText + "</span></label></span>", r = e.options.buttonBefore ? i + e.htmlInput() : e.htmlInput() + i, e.$elementFilestyle = c("<div class=\"bootstrap-filestyle input-group\">" + r + "</div>"), e.$elementFilestyle.find(".group-span-filestyle").attr("tabindex", "0").keypress(function(n) {
                                if (13 === n.keyCode || 32 === n.charCode) return e.$elementFilestyle.find("label").click(), !1
                            }), e.$element.css({
                                position: "absolute",
                                clip: "rect(0px 0px 0px 0px)"
                            }).attr("tabindex", "-1").after(e.$elementFilestyle), e.options.disabled && e.$element.attr("disabled", "true"), e.$element.change(function() {
                                var n = e.pushNameFiles();
                                0 == e.options.input && e.options.badge ? 0 == e.$elementFilestyle.find(".badge").length ? e.$elementFilestyle.find("label").append(" <span class=\"badge\">" + n.length + "</span>") : 0 == n.length ? e.$elementFilestyle.find(".badge").remove() : e.$elementFilestyle.find(".badge").html(n.length) : e.$elementFilestyle.find(".badge").remove()
                            }), -1 < window.navigator.userAgent.search(/firefox/i) && e.$elementFilestyle.find("label").click(function() {
                                return e.$element.click(), !1
                            })
                        }
                    };
                    var n = c.fn.filestyle;
                    c.fn.filestyle = function(t, n) {
                        var o = "";
                        return this.each(function() {
                            var r, s, i;
                            "file" === c(this).attr("type") && (s = (r = c(this)).data("filestyle"), i = c.extend({}, c.fn.filestyle.defaults, t, "object" == typeof t && t), s || (r.data("filestyle", s = new e(this, i)), s.constructor()), "string" == typeof t && (o = s[t](n)))
                        }), o
                    }, c.fn.filestyle.defaults = {
                        buttonText: "Choose file",
                        iconName: "glyphicon glyphicon-folder-open",
                        buttonName: "btn-default",
                        size: "nr",
                        input: !0,
                        badge: !0,
                        icon: !0,
                        buttonBefore: !1,
                        disabled: !1,
                        placeholder: ""
                    }, c.fn.filestyle.noConflict = function() {
                        return c.fn.filestyle = n, this
                    }, c(function() {
                        c(".filestyle").each(function() {
                            var t = c(this),
                                n = {
                                    input: "false" !== t.attr("data-input"),
                                    icon: "false" !== t.attr("data-icon"),
                                    buttonBefore: "true" === t.attr("data-buttonBefore"),
                                    disabled: "true" === t.attr("data-disabled"),
                                    size: t.attr("data-size"),
                                    buttonText: t.attr("data-buttonText"),
                                    buttonName: t.attr("data-buttonName"),
                                    iconName: t.attr("data-iconName"),
                                    badge: "false" !== t.attr("data-badge"),
                                    placeholder: t.attr("data-placeholder")
                                };
                            t.filestyle(n)
                        })
                    })
                }(window.jQuery)
            },
            285: () => {
                var t;
                (t = jQuery).fn.scrollbox = function(s) {
                    return (s = t.extend({
                        linear: !1,
                        startDelay: 2,
                        delay: 3,
                        step: 5,
                        speed: 32,
                        switchItems: 1,
                        direction: "vertical",
                        distance: "auto",
                        autoPlay: !0,
                        onMouseOverPause: !0,
                        paused: !1,
                        queue: null,
                        listElement: "ul",
                        listItemElement: "li",
                        infiniteLoop: !0,
                        switchAmount: 0,
                        afterForward: null,
                        afterBackward: null,
                        triggerStackable: !1
                    }, s)).scrollOffset = "vertical" === s.direction ? "scrollTop" : "scrollLeft", s.queue && (s.queue = t("#" + s.queue)), this.each(function() {
                        var e = t(this),
                            n = null,
                            a = null,
                            l = !1,
                            d = 0,
                            p = 0,
                            u, f, o, g, r, i, m, h, y;
                        s.onMouseOverPause && (e.bind("mouseover", function() {
                            l = !0
                        }), e.bind("mouseout", function() {
                            l = !1
                        })), u = e.children(s.listElement + ":first-child"), !1 === s.infiniteLoop && 0 === s.switchAmount && (s.switchAmount = u.children().length), i = function() {
                            if (!l) {
                                var c = u.children(s.listItemElement + ":first-child"),
                                    c = "auto" === s.distance ? "vertical" === s.direction ? c.outerHeight(!0) : c.outerWidth(!0) : s.distance,
                                    m = s.linear ? Math.min(e[0][s.scrollOffset] + s.step, c) : (m = Math.max(3, parseInt(.3 * (c - e[0][s.scrollOffset]), 10)), Math.min(e[0][s.scrollOffset] + m, c)),
                                    h;
                                if (c <= (e[0][s.scrollOffset] = m)) {
                                    for (h = 0; h < s.switchItems; h++) s.queue && 0 < s.queue.find(s.listItemElement).length ? (u.append(s.queue.find(s.listItemElement)[0]), u.children(s.listItemElement + ":first-child").remove()) : u.append(u.children(s.listItemElement + ":first-child")), ++d;
                                    e[0][s.scrollOffset] = 0, clearInterval(n), n = null, t.isFunction(s.afterForward) && s.afterForward.call(e, {
                                        switchCount: d,
                                        currentFirstChild: u.children(s.listItemElement + ":first-child")
                                    }), s.triggerStackable && 0 !== p ? f() : !1 === s.infiniteLoop && d >= s.switchAmount || s.autoPlay && (a = setTimeout(g, 1e3 * s.delay))
                                }
                            }
                        }, m = function() {
                            if (!l) {
                                var c, m, h;
                                if (0 === e[0][s.scrollOffset]) {
                                    for (c = 0; c < s.switchItems; c++) u.children(s.listItemElement + ":last-child").insertBefore(u.children(s.listItemElement + ":first-child"));
                                    m = u.children(s.listItemElement + ":first-child"), m = "auto" === s.distance ? "vertical" === s.direction ? m.height() : m.width() : s.distance, e[0][s.scrollOffset] = m
                                }
                                h = s.linear ? Math.max(e[0][s.scrollOffset] - s.step, 0) : (h = Math.max(3, parseInt(.3 * e[0][s.scrollOffset], 10)), Math.max(e[0][s.scrollOffset] - h, 0)), 0 === (e[0][s.scrollOffset] = h) && (--d, clearInterval(n), n = null, t.isFunction(s.afterBackward) && s.afterBackward.call(e, {
                                    switchCount: d,
                                    currentFirstChild: u.children(s.listItemElement + ":first-child")
                                }), s.triggerStackable && 0 !== p ? f() : s.autoPlay && (a = setTimeout(g, 1e3 * s.delay)))
                            }
                        }, f = function() {
                            0 !== p && (a = 0 < p ? (p--, setTimeout(g, 0)) : (p++, setTimeout(o, 0)))
                        }, g = function() {
                            clearInterval(n), n = setInterval(i, s.speed)
                        }, o = function() {
                            clearInterval(n), n = setInterval(m, s.speed)
                        }, h = function() {
                            s.autoPlay = !0, l = !1, clearInterval(n), n = setInterval(i, s.speed)
                        }, y = function() {
                            l = !0
                        }, r = function(e) {
                            s.delay = e || s.delay, clearTimeout(a), s.autoPlay && (a = setTimeout(g, 1e3 * s.delay))
                        }, s.autoPlay && (a = setTimeout(g, 1e3 * s.startDelay)), e.bind("resetClock", function(e) {
                            r(e)
                        }), e.bind("forward", function() {
                            s.triggerStackable ? null === n ? g() : p++ : (clearTimeout(a), g())
                        }), e.bind("backward", function() {
                            s.triggerStackable ? null === n ? o() : p-- : (clearTimeout(a), o())
                        }), e.bind("pauseHover", function() {
                            y()
                        }), e.bind("forwardHover", function() {
                            h()
                        }), e.bind("speedUp", function(t, n) {
                            "undefined" === n && (n = Math.max(1, parseInt(s.speed / 2, 10))), s.speed = n
                        }), e.bind("speedDown", function(t, n) {
                            "undefined" === n && (n = 2 * s.speed), s.speed = n
                        }), e.bind("updateConfig", function(o, n) {
                            s = t.extend(s, n)
                        })
                    })
                }
            },
            877: () => {
                ! function(u) {
                    "use strict";

                    function n(e, n) {
                        return u.map(e, function(e) {
                            return e + ".touchspin_" + n
                        })
                    }
                    var t = 0;
                    u.fn.TouchSpin = function(o) {
                        if ("destroy" !== o) {
                            var r = {
                                    min: 0,
                                    max: 100,
                                    initval: "",
                                    replacementval: "",
                                    step: 1,
                                    decimals: 0,
                                    stepinterval: 100,
                                    forcestepdivisibility: "round",
                                    stepintervaldelay: 500,
                                    verticalbuttons: !1,
                                    verticalupclass: "glyphicon glyphicon-chevron-up",
                                    verticaldownclass: "glyphicon glyphicon-chevron-down",
                                    prefix: "",
                                    postfix: "",
                                    prefix_extraclass: "",
                                    postfix_extraclass: "",
                                    booster: !0,
                                    boostat: 10,
                                    maxboostedstep: !1,
                                    mousewheel: !0,
                                    buttondown_class: "btn btn-default",
                                    buttonup_class: "btn btn-default",
                                    buttondown_txt: "-",
                                    buttonup_txt: "+"
                                },
                                s = {
                                    min: "min",
                                    max: "max",
                                    initval: "init-val",
                                    replacementval: "replacement-val",
                                    step: "step",
                                    decimals: "decimals",
                                    stepinterval: "step-interval",
                                    verticalbuttons: "vertical-buttons",
                                    verticalupclass: "vertical-up-class",
                                    verticaldownclass: "vertical-down-class",
                                    forcestepdivisibility: "force-step-divisibility",
                                    stepintervaldelay: "step-interval-delay",
                                    prefix: "prefix",
                                    postfix: "postfix",
                                    prefix_extraclass: "prefix-extra-class",
                                    postfix_extraclass: "postfix-extra-class",
                                    booster: "booster",
                                    boostat: "boostat",
                                    maxboostedstep: "max-boosted-step",
                                    mousewheel: "mouse-wheel",
                                    buttondown_class: "button-down-class",
                                    buttonup_class: "button-up-class",
                                    buttondown_txt: "button-down-txt",
                                    buttonup_txt: "button-up-txt"
                                };
                            return this.each(function() {
                                function i() {
                                    var e = m.val(),
                                        t, o;
                                    "" === e ? "" !== y.replacementval && (m.val(y.replacementval), m.trigger("change")) : 0 < y.decimals && "." === e || (t = parseFloat(e), (o = t = isNaN(t) ? "" === y.replacementval ? 0 : y.replacementval : t).toString() !== e && (o = t), t < y.min && (o = y.min), o = function(e) {
                                        switch (y.forcestepdivisibility) {
                                            case "round":
                                                return (Math.round(e / y.step) * y.step).toFixed(y.decimals);
                                            case "floor":
                                                return (Math.floor(e / y.step) * y.step).toFixed(y.decimals);
                                            case "ceil":
                                                return (Math.ceil(e / y.step) * y.step).toFixed(y.decimals);
                                            default:
                                                return e;
                                        }
                                    }(o = t > y.max ? y.max : o), (+e).toString() !== o.toString() && (m.val(o), m.trigger("change")))
                                }

                                function a() {
                                    if (y.booster) {
                                        var e = Math.pow(2, Math.floor(c / y.boostat)) * y.step;
                                        return y.maxboostedstep && e > y.maxboostedstep && (e = y.maxboostedstep, _ = Math.round(_ / e) * e), Math.max(y.step, e)
                                    }
                                    return y.step
                                }

                                function l() {
                                    i(), _ = parseFloat(v.input.val());
                                    var t = _ = isNaN(_) ? 0 : _,
                                        n = a();
                                    (_ += n) > y.max && (_ = y.max, m.trigger("touchspin.on.max"), g()), v.input.val((+_).toFixed(y.decimals)), t !== _ && m.trigger("change")
                                }

                                function d() {
                                    i(), _ = parseFloat(v.input.val());
                                    var t = _ = isNaN(_) ? 0 : _,
                                        n = a();
                                    (_ -= n) < y.min && (_ = y.min, m.trigger("touchspin.on.min"), g()), v.input.val(_.toFixed(y.decimals)), t !== _ && m.trigger("change")
                                }

                                function p() {
                                    g(), c = 0, h = "down", m.trigger("touchspin.on.startspin"), m.trigger("touchspin.on.startdownspin"), C = setTimeout(function() {
                                        x = setInterval(function() {
                                            c++, d()
                                        }, y.stepinterval)
                                    }, y.stepintervaldelay)
                                }

                                function f() {
                                    g(), c = 0, h = "up", m.trigger("touchspin.on.startspin"), m.trigger("touchspin.on.startupspin"), T = setTimeout(function() {
                                        S = setInterval(function() {
                                            c++, l()
                                        }, y.stepinterval)
                                    }, y.stepintervaldelay)
                                }

                                function g() {
                                    switch (clearTimeout(C), clearTimeout(T), clearInterval(x), clearInterval(S), h) {
                                        case "up":
                                            m.trigger("touchspin.on.stopupspin"), m.trigger("touchspin.on.stopspin");
                                            break;
                                        case "down":
                                            m.trigger("touchspin.on.stopdownspin"), m.trigger("touchspin.on.stopspin");
                                    }
                                    c = 0, h = !1
                                }
                                var m = u(this),
                                    e = m.data(),
                                    c = 0,
                                    h = !1,
                                    y, b, v, _, x, S, C, T;
                                m.data("alreadyinitialized") || (m.data("alreadyinitialized", !0), t += 1, m.data("spinnerid", t), m.is("input") && ("" !== (y = u.extend({}, r, e, function() {
                                    var t = {};
                                    return u.each(s, function(o, n) {
                                        n = "bts-" + n, m.is("[data-" + n + "]") && (t[o] = m.data(n))
                                    }), t
                                }(), o)).initval && "" === m.val() && m.val(y.initval), i(), function() {
                                    var e = m.val(),
                                        t = m.parent();
                                    "" !== e && (e = (+e).toFixed(y.decimals)), m.data("initvalue", e).val(e), m.addClass("form-control"), t.hasClass("input-group") ? function(t) {
                                        t.addClass("bootstrap-touchspin");
                                        var n = m.prev(),
                                            e = m.next(),
                                            i = "<span class=\"input-group-addon bootstrap-touchspin-prefix\">" + y.prefix + "</span>",
                                            r = "<span class=\"input-group-addon bootstrap-touchspin-postfix\">" + y.postfix + "</span>",
                                            o, a;
                                        n.hasClass("input-group-btn") ? (o = "<button class=\"" + y.buttondown_class + " bootstrap-touchspin-down\" type=\"button\">" + y.buttondown_txt + "</button>", n.append(o)) : (o = "<span class=\"input-group-btn\"><button class=\"" + y.buttondown_class + " bootstrap-touchspin-down\" type=\"button\">" + y.buttondown_txt + "</button></span>", u(o).insertBefore(m)), e.hasClass("input-group-btn") ? (a = "<button class=\"" + y.buttonup_class + " bootstrap-touchspin-up\" type=\"button\">" + y.buttonup_txt + "</button>", e.prepend(a)) : (a = "<span class=\"input-group-btn\"><button class=\"" + y.buttonup_class + " bootstrap-touchspin-up\" type=\"button\">" + y.buttonup_txt + "</button></span>", u(a).insertAfter(m)), u(i).insertBefore(m), u(r).insertAfter(m), b = t
                                    }(t) : function() {
                                        var e;
                                        e = y.verticalbuttons ? "<div class=\"input-group bootstrap-touchspin\"><span class=\"input-group-addon bootstrap-touchspin-prefix\">" + y.prefix + "</span><span class=\"input-group-addon bootstrap-touchspin-postfix\">" + y.postfix + "</span><span class=\"input-group-btn-vertical\"><button class=\"" + y.buttondown_class + " bootstrap-touchspin-up\" type=\"button\"><i class=\"" + y.verticalupclass + "\"></i></button><button class=\"" + y.buttonup_class + " bootstrap-touchspin-down\" type=\"button\"><i class=\"" + y.verticaldownclass + "\"></i></button></span></div>" : "<div class=\"input-group bootstrap-touchspin\"><span class=\"input-group-btn\"><button class=\"" + y.buttondown_class + " bootstrap-touchspin-down\" type=\"button\">" + y.buttondown_txt + "</button></span><span class=\"input-group-addon bootstrap-touchspin-prefix\">" + y.prefix + "</span><span class=\"input-group-addon bootstrap-touchspin-postfix\">" + y.postfix + "</span><span class=\"input-group-btn\"><button class=\"" + y.buttonup_class + " bootstrap-touchspin-up\" type=\"button\">" + y.buttonup_txt + "</button></span></div>", b = u(e).insertBefore(m), u(".bootstrap-touchspin-prefix", b).after(m), m.hasClass("input-sm") ? b.addClass("input-group-sm") : m.hasClass("input-lg") && b.addClass("input-group-lg")
                                    }()
                                }(), v = {
                                    down: u(".bootstrap-touchspin-down", b),
                                    up: u(".bootstrap-touchspin-up", b),
                                    input: u("input", b),
                                    prefix: u(".bootstrap-touchspin-prefix", b).addClass(y.prefix_extraclass),
                                    postfix: u(".bootstrap-touchspin-postfix", b).addClass(y.postfix_extraclass)
                                }, function() {
                                    "" === y.prefix && v.prefix.hide(), "" === y.postfix && v.postfix.hide()
                                }(), m.on("keydown", function(t) {
                                    var n = t.keyCode || t.which;
                                    38 === n ? ("up" !== h && (l(), f()), t.preventDefault()) : 40 === n && ("down" !== h && (d(), p()), t.preventDefault())
                                }), m.on("keyup", function(e) {
                                    e = e.keyCode || e.which, 38 !== e && 40 !== e || g()
                                }), m.on("blur", function() {
                                    i()
                                }), v.down.on("keydown", function(t) {
                                    var n = t.keyCode || t.which;
                                    32 !== n && 13 !== n || ("down" !== h && (d(), p()), t.preventDefault())
                                }), v.down.on("keyup", function(e) {
                                    e = e.keyCode || e.which, 32 !== e && 13 !== e || g()
                                }), v.up.on("keydown", function(t) {
                                    var n = t.keyCode || t.which;
                                    32 !== n && 13 !== n || ("up" !== h && (l(), f()), t.preventDefault())
                                }), v.up.on("keyup", function(e) {
                                    e = e.keyCode || e.which, 32 !== e && 13 !== e || g()
                                }), v.down.on("mousedown.touchspin", function(e) {
                                    v.down.off("touchstart.touchspin"), m.is(":disabled") || (d(), p(), e.preventDefault(), e.stopPropagation())
                                }), v.down.on("touchstart.touchspin", function(e) {
                                    v.down.off("mousedown.touchspin"), m.is(":disabled") || (d(), p(), e.preventDefault(), e.stopPropagation())
                                }), v.up.on("mousedown.touchspin", function(e) {
                                    v.up.off("touchstart.touchspin"), m.is(":disabled") || (l(), f(), e.preventDefault(), e.stopPropagation())
                                }), v.up.on("touchstart.touchspin", function(e) {
                                    v.up.off("mousedown.touchspin"), m.is(":disabled") || (l(), f(), e.preventDefault(), e.stopPropagation())
                                }), v.up.on("mouseout touchleave touchend touchcancel", function(e) {
                                    h && (e.stopPropagation(), g())
                                }), v.down.on("mouseout touchleave touchend touchcancel", function(e) {
                                    h && (e.stopPropagation(), g())
                                }), v.down.on("mousemove touchmove", function(e) {
                                    h && (e.stopPropagation(), e.preventDefault())
                                }), v.up.on("mousemove touchmove", function(e) {
                                    h && (e.stopPropagation(), e.preventDefault())
                                }), u(document).on(n(["mouseup", "touchend", "touchcancel"], t).join(" "), function(e) {
                                    h && (e.preventDefault(), g())
                                }), u(document).on(n(["mousemove", "touchmove", "scroll", "scrollstart"], t).join(" "), function(e) {
                                    h && (e.preventDefault(), g())
                                }), m.on("mousewheel DOMMouseScroll", function(t) {
                                    var n;
                                    y.mousewheel && m.is(":focus") && (n = t.originalEvent.wheelDelta || -t.originalEvent.deltaY || -t.originalEvent.detail, t.stopPropagation(), t.preventDefault(), (0 > n ? d : l)())
                                }), m.on("touchspin.uponce", function() {
                                    g(), l()
                                }), m.on("touchspin.downonce", function() {
                                    g(), d()
                                }), m.on("touchspin.startupspin", function() {
                                    f()
                                }), m.on("touchspin.startdownspin", function() {
                                    p()
                                }), m.on("touchspin.stopspin", function() {
                                    g()
                                }), m.on("touchspin.updatesettings", function(t, n) {
                                    ! function(e) {
                                        (function(e) {
                                            y = u.extend({}, y, e)
                                        })(e), i(), e = v.input.val(), "" !== e && (e = +v.input.val(), v.input.val(e.toFixed(y.decimals)))
                                    }(n)
                                }), v.input.css("display", "block")))
                            })
                        }
                        this.each(function() {
                            var e = u(this).data();
                            u(document).off(n(["mouseup", "touchend", "touchcancel", "mousemove", "touchmove", "scroll", "scrollstart"], e.spinnerid).join(" "))
                        })
                    }
                }(jQuery)
            },
            948: () => {
                function m(t, n) {
                    if (!(t instanceof n)) throw new TypeError("Cannot call a class as a function")
                }

                function e(n) {
                    var o = this,
                        e = !1;
                    return r(this).one(a.TRANSITION_END, function() {
                        e = !0
                    }), setTimeout(function() {
                        e || a.triggerTransitionEnd(o)
                    }, n), this
                }

                function n(n, o) {
                    for (var e = 0, s; e < o.length; e++) s = o[e], s.enumerable = s.enumerable || !1, s.configurable = !0, "value" in s && (s.writable = !0), Object.defineProperty(n, s.key, s)
                }
                if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
                var r, o, s, a, y, b, v, _;
                ! function() {
                    var e = jQuery.fn.jquery.split(" ")[0].split(".");
                    if (2 > e[0] && 9 > e[1] || 1 == e[0] && 9 == e[1] && 1 > e[2] || 4 <= e[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
                }(), y = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                        return typeof e
                    } : function(e) {
                        return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
                    }, r = jQuery, o = !(b = function(r, o, e) {
                        return o && n(r.prototype, o), e && n(r, e), r
                    }), s = {
                        WebkitTransition: "webkitTransitionEnd",
                        MozTransition: "transitionend",
                        OTransition: "oTransitionEnd otransitionend",
                        transition: "transitionend"
                    }, a = {
                        TRANSITION_END: "bsTransitionEnd",
                        getUID: function(e) {
                            for (; e += ~~(1e6 * Math.random()), document.getElementById(e););
                            return e
                        },
                        getSelectorFromElement: function(t) {
                            var n = t.getAttribute("data-target");
                            return n || (n = t.getAttribute("href") || "", n = /^#[a-z]/i.test(n) ? n : null), n
                        },
                        reflow: function(e) {
                            new Function("bs", "return bs")(e.offsetHeight)
                        },
                        triggerTransitionEnd: function(e) {
                            r(e).trigger(o.end)
                        },
                        supportsTransitionEnd: function() {
                            return !!o
                        },
                        typeCheckConfig: function(o, a, e) {
                            for (var t in e)
                                if (e.hasOwnProperty(t)) {
                                    var n = e[t],
                                        i = a[t],
                                        l = i && ((d = i)[0] || d).nodeType ? "element" : (i = i, {}.toString.call(i).match(/\s([a-zA-Z]+)/)[1].toLowerCase());
                                    if (!new RegExp(n).test(l)) throw new Error(o.toUpperCase() + ": Option \"" + t + "\" provided type \"" + l + "\" but expected type \"" + n + "\".")
                                }
                            var d
                        }
                    }, o = function() {
                        if (window.QUnit) return !1;
                        var e = document.createElement("bootstrap"),
                            n;
                        for (n in s)
                            if (void 0 !== e.style[n]) return {
                                end: s[n]
                            };
                        return !1
                    }(), r.fn.emulateTransitionEnd = e, a.supportsTransitionEnd() && (r.event.special[a.TRANSITION_END] = {
                        bindType: o.end,
                        delegateType: o.end,
                        handle: function(e) {
                            if (r(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
                        }
                    }), v = a,
                    function(s) {
                        function r(e) {
                            m(this, r), this._element = e
                        }
                        var o = s.fn.alert,
                            i = {
                                CLOSE: "close.bs.alert",
                                CLOSED: "closed.bs.alert",
                                CLICK_DATA_API: "click.bs.alert.data-api"
                            },
                            e = (r.prototype.close = function(e) {
                                e = e || this._element, e = this._getRootElement(e), this._triggerCloseEvent(e).isDefaultPrevented() || this._removeElement(e)
                            }, r.prototype.dispose = function() {
                                s.removeData(this._element, "bs.alert"), this._element = null
                            }, r.prototype._getRootElement = function(n) {
                                var o = v.getSelectorFromElement(n),
                                    e = !1;
                                return e = (e = o ? s(o)[0] : e) || s(n).closest(".alert")[0]
                            }, r.prototype._triggerCloseEvent = function(t) {
                                var n = s.Event(i.CLOSE);
                                return s(t).trigger(n), n
                            }, r.prototype._removeElement = function(e) {
                                return s(e).removeClass("in"), v.supportsTransitionEnd() && s(e).hasClass("fade") ? void s(e).one(v.TRANSITION_END, s.proxy(this._destroyElement, this, e)).emulateTransitionEnd(150) : void this._destroyElement(e)
                            }, r.prototype._destroyElement = function(e) {
                                s(e).detach().trigger(i.CLOSED).remove()
                            }, r._jQueryInterface = function(t) {
                                return this.each(function() {
                                    var o = s(this),
                                        n = o.data("bs.alert");
                                    n || (n = new r(this), o.data("bs.alert", n)), "close" === t && n[t](this)
                                })
                            }, r._handleDismiss = function(e) {
                                return function(n) {
                                    n && n.preventDefault(), e.close(this)
                                }
                            }, b(r, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }]), r);
                        s(document).on(i.CLICK_DATA_API, "[data-dismiss=\"alert\"]", e._handleDismiss(new e)), s.fn.alert = e._jQueryInterface, s.fn.alert.Constructor = e, s.fn.alert.noConflict = function() {
                            return s.fn.alert = o, e._jQueryInterface
                        }
                    }(jQuery),
                    function(s) {
                        function r(e) {
                            m(this, r), this._element = e
                        }
                        var n = ".data-api",
                            i = s.fn.button,
                            n = {
                                CLICK_DATA_API: "click.bs.button" + n,
                                FOCUS_BLUR_DATA_API: "focus.bs.button" + n + " blur.bs.button" + n
                            },
                            a = (r.prototype.toggle = function() {
                                var e = !0,
                                    t = s(this._element).closest("[data-toggle=\"buttons\"]")[0],
                                    n;
                                t ? (n = s(this._element).find("input")[0]) && ("radio" === n.type && (n.checked && s(this._element).hasClass("active") ? e = !1 : (t = s(t).find(".active")[0]) && s(t).removeClass("active")), e && (n.checked = !s(this._element).hasClass("active"), s(this._element).trigger("change")), n.focus()) : this._element.setAttribute("aria-pressed", !s(this._element).hasClass("active")), e && s(this._element).toggleClass("active")
                            }, r.prototype.dispose = function() {
                                s.removeData(this._element, "bs.button"), this._element = null
                            }, r._jQueryInterface = function(e) {
                                return this.each(function() {
                                    var n = s(this).data("bs.button");
                                    n || (n = new r(this), s(this).data("bs.button", n)), "toggle" === e && n[e]()
                                })
                            }, b(r, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }]), r);
                        s(document).on(n.CLICK_DATA_API, "[data-toggle^=\"button\"]", function(e) {
                            e.preventDefault(), e = e.target, s(e).hasClass("btn") || (e = s(e).closest(".btn")), a._jQueryInterface.call(s(e), "toggle")
                        }).on(n.FOCUS_BLUR_DATA_API, "[data-toggle^=\"button\"]", function(t) {
                            var n = s(t.target).closest(".btn")[0];
                            s(n).toggleClass("focus", /^focus(in)?$/.test(t.type))
                        }), s.fn.button = a._jQueryInterface, s.fn.button.Constructor = a, s.fn.button.noConflict = function() {
                            return s.fn.button = i, a._jQueryInterface
                        }
                    }(jQuery),
                    function(u) {
                        function l(t, n) {
                            m(this, l), this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this._config = this._getConfig(n), this._element = u(t)[0], this._indicatorsElement = u(this._element).find(d.INDICATORS)[0], this._addEventListeners()
                        }
                        var o = u.fn.carousel,
                            e = {
                                interval: 5e3,
                                keyboard: !0,
                                slide: !1,
                                pause: "hover",
                                wrap: !0
                            },
                            r = {
                                interval: "(number|boolean)",
                                keyboard: "boolean",
                                slide: "(boolean|string)",
                                pause: "(string|boolean)",
                                wrap: "boolean"
                            },
                            f = {
                                SLIDE: "slide.bs.carousel",
                                SLID: "slid.bs.carousel",
                                KEYDOWN: "keydown.bs.carousel",
                                MOUSEENTER: "mouseenter.bs.carousel",
                                MOUSELEAVE: "mouseleave.bs.carousel",
                                LOAD_DATA_API: "load.bs.carousel.data-api",
                                CLICK_DATA_API: "click.bs.carousel.data-api"
                            },
                            d = {
                                ACTIVE: ".active",
                                ACTIVE_ITEM: ".active.carousel-item",
                                ITEM: ".carousel-item",
                                NEXT_PREV: ".next, .prev",
                                INDICATORS: ".carousel-indicators",
                                DATA_SLIDE: "[data-slide], [data-slide-to]",
                                DATA_RIDE: "[data-ride=\"carousel\"]"
                            },
                            s = (l.prototype.next = function() {
                                this._isSliding || this._slide("next")
                            }, l.prototype.nextWhenVisible = function() {
                                document.hidden || this.next()
                            }, l.prototype.prev = function() {
                                this._isSliding || this._slide("prev")
                            }, l.prototype.pause = function(e) {
                                e || (this._isPaused = !0), u(this._element).find(d.NEXT_PREV)[0] && v.supportsTransitionEnd() && (v.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
                            }, l.prototype.cycle = function(e) {
                                e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval(u.proxy(document.visibilityState ? this.nextWhenVisible : this.next, this), this._config.interval))
                            }, l.prototype.to = function(n) {
                                var o = this;
                                this._activeElement = u(this._element).find(d.ACTIVE_ITEM)[0];
                                var e = this._getItemIndex(this._activeElement);
                                if (!(n > this._items.length - 1 || 0 > n))
                                    if (this._isSliding) u(this._element).one(f.SLID, function() {
                                        return o.to(n)
                                    });
                                    else {
                                        if (e === n) return this.pause(), void this.cycle();
                                        this._slide(e < n ? "next" : "prev", this._items[n])
                                    }
                            }, l.prototype.dispose = function() {
                                u(this._element).off(".bs.carousel"), u.removeData(this._element, "bs.carousel"), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
                            }, l.prototype._getConfig = function(t) {
                                return t = u.extend({}, e, t), v.typeCheckConfig("carousel", t, r), t
                            }, l.prototype._addEventListeners = function() {
                                this._config.keyboard && u(this._element).on(f.KEYDOWN, u.proxy(this._keydown, this)), "hover" !== this._config.pause || "ontouchstart" in document.documentElement || u(this._element).on(f.MOUSEENTER, u.proxy(this.pause, this)).on(f.MOUSELEAVE, u.proxy(this.cycle, this))
                            }, l.prototype._keydown = function(e) {
                                if (e.preventDefault(), !/input|textarea/i.test(e.target.tagName)) switch (e.which) {
                                    case 37:
                                        this.prev();
                                        break;
                                    case 39:
                                        this.next();
                                        break;
                                    default:
                                }
                            }, l.prototype._getItemIndex = function(e) {
                                return this._items = u.makeArray(u(e).parent().find(d.ITEM)), this._items.indexOf(e)
                            }, l.prototype._getItemByDirection = function(e, o) {
                                var a = "next" === e,
                                    t = "prev" === e,
                                    n = this._getItemIndex(o),
                                    i = this._items.length - 1;
                                return (t && 0 === n || a && n === i) && !this._config.wrap ? o : (e = (n + ("prev" === e ? -1 : 1)) % this._items.length, -1 == e ? this._items[this._items.length - 1] : this._items[e])
                            }, l.prototype._triggerSlideEvent = function(t, n) {
                                return n = u.Event(f.SLIDE, {
                                    relatedTarget: t,
                                    direction: n
                                }), u(this._element).trigger(n), n
                            }, l.prototype._setActiveIndicatorElement = function(e) {
                                this._indicatorsElement && (u(this._indicatorsElement).find(d.ACTIVE).removeClass("active"), (e = this._indicatorsElement.children[this._getItemIndex(e)]) && u(e).addClass("active"))
                            }, l.prototype._slide = function(t, n) {
                                var a = this,
                                    l = u(this._element).find(d.ACTIVE_ITEM)[0],
                                    i = n || l && this._getItemByDirection(t, l),
                                    n = !!this._interval,
                                    r = "next" === t ? "left" : "right",
                                    o;
                                i && u(i).hasClass("active") ? this._isSliding = !1 : !this._triggerSlideEvent(i, r).isDefaultPrevented() && l && i && (this._isSliding = !0, n && this.pause(), this._setActiveIndicatorElement(i), o = u.Event(f.SLID, {
                                    relatedTarget: i,
                                    direction: r
                                }), v.supportsTransitionEnd() && u(this._element).hasClass("slide") ? (u(i).addClass(t), v.reflow(i), u(l).addClass(r), u(i).addClass(r), u(l).one(v.TRANSITION_END, function() {
                                    u(i).removeClass(r).removeClass(t), u(i).addClass("active"), u(l).removeClass("active").removeClass(t).removeClass(r), a._isSliding = !1, setTimeout(function() {
                                        return u(a._element).trigger(o)
                                    }, 0)
                                }).emulateTransitionEnd(600)) : (u(l).removeClass("active"), u(i).addClass("active"), this._isSliding = !1, u(this._element).trigger(o)), n && this.cycle())
                            }, l._jQueryInterface = function(n) {
                                return this.each(function() {
                                    var o = u(this).data("bs.carousel"),
                                        r = u.extend({}, e, u(this).data());
                                    "object" === (void 0 === n ? "undefined" : y(n)) && u.extend(r, n);
                                    var s = "string" == typeof n ? n : r.slide;
                                    if (o || (o = new l(this, r), u(this).data("bs.carousel", o)), "number" == typeof n) o.to(n);
                                    else if ("string" == typeof s) {
                                        if (void 0 === o[s]) throw new Error("No method named \"" + s + "\"");
                                        o[s]()
                                    } else r.interval && (o.pause(), o.cycle())
                                })
                            }, l._dataApiClickHandler = function(t) {
                                var n = v.getSelectorFromElement(this),
                                    o, r;
                                !n || (o = u(n)[0]) && u(o).hasClass("carousel") && (r = u.extend({}, u(o).data(), u(this).data()), (n = this.getAttribute("data-slide-to")) && (r.interval = !1), l._jQueryInterface.call(u(o), r), n && u(o).data("bs.carousel").to(n), t.preventDefault())
                            }, b(l, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }, {
                                key: "Default",
                                get: function() {
                                    return e
                                }
                            }]), l);
                        u(document).on(f.CLICK_DATA_API, d.DATA_SLIDE, s._dataApiClickHandler), u(window).on(f.LOAD_DATA_API, function() {
                            u(d.DATA_RIDE).each(function() {
                                var e = u(this);
                                s._jQueryInterface.call(e, e.data())
                            })
                        }), u.fn.carousel = s._jQueryInterface, u.fn.carousel.Constructor = s, u.fn.carousel.noConflict = function() {
                            return u.fn.carousel = o, s._jQueryInterface
                        }
                    }(jQuery),
                    function(u) {
                        function l(t, n) {
                            m(this, l), this._isTransitioning = !1, this._element = t, this._config = this._getConfig(n), this._triggerArray = u.makeArray(u("[data-toggle=\"collapse\"][href=\"#" + t.id + "\"],[data-toggle=\"collapse\"][data-target=\"#" + t.id + "\"]")), this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
                        }
                        var e = ".bs.collapse",
                            o = u.fn.collapse,
                            a = {
                                toggle: !0,
                                parent: ""
                            },
                            s = {
                                toggle: "boolean",
                                parent: "string"
                            },
                            n = {
                                SHOW: "show" + e,
                                SHOWN: "shown" + e,
                                HIDE: "hide" + e,
                                HIDDEN: "hidden" + e,
                                CLICK_DATA_API: "click" + e + ".data-api"
                            },
                            e = "[data-toggle=\"collapse\"]",
                            i = (l.prototype.toggle = function() {
                                u(this._element).hasClass("in") ? this.hide() : this.show()
                            }, l.prototype.show = function() {
                                var e = this,
                                    t, o, s, i;
                                this._isTransitioning || u(this._element).hasClass("in") || (s = i = void 0, this._parent && ((i = u.makeArray(u(".card > .in, .card > .collapsing"))).length || (i = null)), i && (s = u(i).data("bs.collapse")) && s._isTransitioning || (t = u.Event(n.SHOW), u(this._element).trigger(t), t.isDefaultPrevented() || (i && (l._jQueryInterface.call(u(i), "hide"), s || u(i).data("bs.collapse", null)), o = this._getDimension(), u(this._element).removeClass("collapse").addClass("collapsing"), this._element.style[o] = 0, this._element.setAttribute("aria-expanded", !0), this._triggerArray.length && u(this._triggerArray).removeClass("collapsed").attr("aria-expanded", !0), this.setTransitioning(!0), s = function() {
                                    u(e._element).removeClass("collapsing").addClass("collapse").addClass("in"), e._element.style[o] = "", e.setTransitioning(!1), u(e._element).trigger(n.SHOWN)
                                }, v.supportsTransitionEnd() ? (i = "scroll" + (o[0].toUpperCase() + o.slice(1)), u(this._element).one(v.TRANSITION_END, s).emulateTransitionEnd(600), this._element.style[o] = this._element[i] + "px") : s())))
                            }, l.prototype.hide = function() {
                                var t = this;
                                if (!this._isTransitioning && u(this._element).hasClass("in")) {
                                    var o = u.Event(n.HIDE);
                                    if (u(this._element).trigger(o), !o.isDefaultPrevented()) {
                                        var s = this._getDimension();
                                        return this._element.style[s] = this._element["width" === s ? "offsetWidth" : "offsetHeight"] + "px", v.reflow(this._element), u(this._element).addClass("collapsing").removeClass("collapse").removeClass("in"), this._element.setAttribute("aria-expanded", !1), this._triggerArray.length && u(this._triggerArray).addClass("collapsed").attr("aria-expanded", !1), this.setTransitioning(!0), o = function() {
                                            t.setTransitioning(!1), u(t._element).removeClass("collapsing").addClass("collapse").trigger(n.HIDDEN)
                                        }, this._element.style[s] = "", v.supportsTransitionEnd() ? void u(this._element).one(v.TRANSITION_END, o).emulateTransitionEnd(600) : void o()
                                    }
                                }
                            }, l.prototype.setTransitioning = function(e) {
                                this._isTransitioning = e
                            }, l.prototype.dispose = function() {
                                u.removeData(this._element, "bs.collapse"), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
                            }, l.prototype._getConfig = function(e) {
                                return (e = u.extend({}, a, e)).toggle = !!e.toggle, v.typeCheckConfig("collapse", e, s), e
                            }, l.prototype._getDimension = function() {
                                return u(this._element).hasClass("width") ? "width" : "height"
                            }, l.prototype._getParent = function() {
                                var t = this,
                                    o = u(this._config.parent)[0],
                                    n = "[data-toggle=\"collapse\"][data-parent=\"" + this._config.parent + "\"]";
                                return u(o).find(n).each(function(o, n) {
                                    t._addAriaAndCollapsedClass(l._getTargetFromElement(n), [n])
                                }), o
                            }, l.prototype._addAriaAndCollapsedClass = function(n, o) {
                                var e;
                                n && (e = u(n).hasClass("in"), n.setAttribute("aria-expanded", e), o.length && u(o).toggleClass("collapsed", !e).attr("aria-expanded", e))
                            }, l._getTargetFromElement = function(e) {
                                return e = v.getSelectorFromElement(e), e ? u(e)[0] : null
                            }, l._jQueryInterface = function(t) {
                                return this.each(function() {
                                    var n = u(this),
                                        o = n.data("bs.collapse"),
                                        r = u.extend({}, a, n.data(), "object" === (void 0 === t ? "undefined" : y(t)) && t);
                                    if (!o && r.toggle && /show|hide/.test(t) && (r.toggle = !1), o || (o = new l(this, r), n.data("bs.collapse", o)), "string" == typeof t) {
                                        if (void 0 === o[t]) throw new Error("No method named \"" + t + "\"");
                                        o[t]()
                                    }
                                })
                            }, b(l, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }, {
                                key: "Default",
                                get: function() {
                                    return a
                                }
                            }]), l);
                        u(document).on(n.CLICK_DATA_API, e, function(e) {
                            e.preventDefault();
                            var t = i._getTargetFromElement(this),
                                e = u(t).data("bs.collapse") ? "toggle" : u(this).data();
                            i._jQueryInterface.call(u(t), e)
                        }), u.fn.collapse = i._jQueryInterface, u.fn.collapse.Constructor = i, u.fn.collapse.noConflict = function() {
                            return u.fn.collapse = o, i._jQueryInterface
                        }
                    }(jQuery),
                    function(i) {
                        function d(e) {
                            m(this, d), this._element = e, this._addEventListeners()
                        }
                        var o = ".data-api",
                            r = i.fn.dropdown,
                            a = {
                                HIDE: "hide.bs.dropdown",
                                HIDDEN: "hidden.bs.dropdown",
                                SHOW: "show.bs.dropdown",
                                SHOWN: "shown.bs.dropdown",
                                CLICK: "click.bs.dropdown",
                                CLICK_DATA_API: "click.bs.dropdown" + o,
                                KEYDOWN_DATA_API: "keydown.bs.dropdown" + o
                            },
                            o = "[role=\"listbox\"]",
                            t = (d.prototype.toggle = function() {
                                if (this.disabled || i(this).hasClass("disabled")) return !1;
                                var t = d._getParentFromElement(this),
                                    n = i(t).hasClass("open");
                                if (d._clearMenus(), n) return !1;
                                "ontouchstart" in document.documentElement && !i(t).closest(".navbar-nav").length && ((o = document.createElement("div")).className = "dropdown-backdrop", i(o).insertBefore(this), i(o).on("click", d._clearMenus));
                                var n = {
                                        relatedTarget: this
                                    },
                                    o = i.Event(a.SHOW, n);
                                return i(t).trigger(o), !o.isDefaultPrevented() && (this.focus(), this.setAttribute("aria-expanded", "true"), i(t).toggleClass("open"), i(t).trigger(i.Event(a.SHOWN, n)), !1)
                            }, d.prototype.dispose = function() {
                                i.removeData(this._element, "bs.dropdown"), i(this._element).off(".bs.dropdown"), this._element = null
                            }, d.prototype._addEventListeners = function() {
                                i(this._element).on(a.CLICK, this.toggle)
                            }, d._jQueryInterface = function(e) {
                                return this.each(function() {
                                    var n = i(this).data("bs.dropdown");
                                    if (n || i(this).data("bs.dropdown", n = new d(this)), "string" == typeof e) {
                                        if (void 0 === n[e]) throw new Error("No method named \"" + e + "\"");
                                        n[e].call(this)
                                    }
                                })
                            }, d._clearMenus = function(r) {
                                if (!r || 3 !== r.which) {
                                    var l = i(".dropdown-backdrop")[0];
                                    l && l.parentNode.removeChild(l);
                                    for (var e = i.makeArray(i("[data-toggle=\"dropdown\"]")), t = 0; t < e.length; t++) {
                                        var p = d._getParentFromElement(e[t]),
                                            c = {
                                                relatedTarget: e[t]
                                            },
                                            o;
                                        !i(p).hasClass("open") || r && "click" === r.type && /input|textarea/i.test(r.target.tagName) && i.contains(p, r.target) || (o = i.Event(a.HIDE, c), i(p).trigger(o), o.isDefaultPrevented() || (e[t].setAttribute("aria-expanded", "false"), i(p).removeClass("open").trigger(i.Event(a.HIDDEN, c))))
                                    }
                                }
                            }, d._getParentFromElement = function(t) {
                                var o = v.getSelectorFromElement(t),
                                    e;
                                return (e = o ? i(o)[0] : e) || t.parentNode
                            }, d._dataApiKeydownHandler = function(t) {
                                if (/(38|40|27|32)/.test(t.which) && !/input|textarea/i.test(t.target.tagName) && (t.preventDefault(), t.stopPropagation(), !this.disabled && !i(this).hasClass("disabled"))) {
                                    var o = d._getParentFromElement(this),
                                        s = i(o).hasClass("open");
                                    if (!s && 27 !== t.which || s && 27 === t.which) return 27 === t.which && (r = i(o).find("[data-toggle=\"dropdown\"]")[0], i(r).trigger("focus")), void i(this).trigger("click");
                                    var o = i.makeArray(i("[role=\"menu\"] li:not(.disabled) a, [role=\"listbox\"] li:not(.disabled) a")),
                                        r;
                                    (o = o.filter(function(e) {
                                        return e.offsetWidth || e.offsetHeight
                                    })).length && (r = o.indexOf(t.target), 38 === t.which && 0 < r && r--, 40 === t.which && r < o.length - 1 && r++, o[r = 0 > r ? 0 : r].focus())
                                }
                            }, b(d, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }]), d);
                        i(document).on(a.KEYDOWN_DATA_API, "[data-toggle=\"dropdown\"]", t._dataApiKeydownHandler).on(a.KEYDOWN_DATA_API, "[role=\"menu\"]", t._dataApiKeydownHandler).on(a.KEYDOWN_DATA_API, o, t._dataApiKeydownHandler).on(a.CLICK_DATA_API, t._clearMenus).on(a.CLICK_DATA_API, "[data-toggle=\"dropdown\"]", t.prototype.toggle).on(a.CLICK_DATA_API, ".dropdown form", function(e) {
                            e.stopPropagation()
                        }), i.fn.dropdown = t._jQueryInterface, i.fn.dropdown.Constructor = t, i.fn.dropdown.noConflict = function() {
                            return i.fn.dropdown = r, t._jQueryInterface
                        }
                    }(jQuery),
                    function(c) {
                        function l(t, n) {
                            m(this, l), this._config = this._getConfig(n), this._element = t, this._dialog = c(t).find(s.DIALOG)[0], this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._originalBodyPadding = 0, this._scrollbarWidth = 0
                        }
                        var o = c.fn.modal,
                            e = {
                                backdrop: !0,
                                keyboard: !0,
                                focus: !0,
                                show: !0
                            },
                            t = {
                                backdrop: "(boolean|string)",
                                keyboard: "boolean",
                                focus: "boolean",
                                show: "boolean"
                            },
                            u = {
                                HIDE: "hide.bs.modal",
                                HIDDEN: "hidden.bs.modal",
                                SHOW: "show.bs.modal",
                                SHOWN: "shown.bs.modal",
                                FOCUSIN: "focusin.bs.modal",
                                RESIZE: "resize.bs.modal",
                                CLICK_DISMISS: "click.dismiss.bs.modal",
                                KEYDOWN_DISMISS: "keydown.dismiss.bs.modal",
                                MOUSEUP_DISMISS: "mouseup.dismiss.bs.modal",
                                MOUSEDOWN_DISMISS: "mousedown.dismiss.bs.modal",
                                CLICK_DATA_API: "click.bs.modal.data-api"
                            },
                            s = {
                                DIALOG: ".modal-dialog",
                                DATA_TOGGLE: "[data-toggle=\"modal\"]",
                                DATA_DISMISS: "[data-dismiss=\"modal\"]",
                                FIXED_CONTENT: ".navbar-fixed-top, .navbar-fixed-bottom, .is-fixed"
                            },
                            n = (l.prototype.toggle = function(e) {
                                return this._isShown ? this.hide() : this.show(e)
                            }, l.prototype.show = function(t) {
                                var n = this,
                                    o = c.Event(u.SHOW, {
                                        relatedTarget: t
                                    });
                                c(this._element).trigger(o), this._isShown || o.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), c(document.body).addClass("modal-open"), this._setEscapeEvent(), this._setResizeEvent(), c(this._element).on(u.CLICK_DISMISS, s.DATA_DISMISS, c.proxy(this.hide, this)), c(this._dialog).on(u.MOUSEDOWN_DISMISS, function() {
                                    c(n._element).one(u.MOUSEUP_DISMISS, function(e) {
                                        c(e.target).is(n._element) && (n._ignoreBackdropClick = !0)
                                    })
                                }), this._showBackdrop(c.proxy(this._showElement, this, t)))
                            }, l.prototype.hide = function(e) {
                                e && e.preventDefault(), e = c.Event(u.HIDE), c(this._element).trigger(e), this._isShown && !e.isDefaultPrevented() && (this._isShown = !1, this._setEscapeEvent(), this._setResizeEvent(), c(document).off(u.FOCUSIN), c(this._element).removeClass("in"), c(this._element).off(u.CLICK_DISMISS), c(this._dialog).off(u.MOUSEDOWN_DISMISS), v.supportsTransitionEnd() && c(this._element).hasClass("fade") ? c(this._element).one(v.TRANSITION_END, c.proxy(this._hideModal, this)).emulateTransitionEnd(300) : this._hideModal())
                            }, l.prototype.dispose = function() {
                                c.removeData(this._element, "bs.modal"), c(window).off(".bs.modal"), c(document).off(".bs.modal"), c(this._element).off(".bs.modal"), c(this._backdrop).off(".bs.modal"), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._originalBodyPadding = null, this._scrollbarWidth = null
                            }, l.prototype._getConfig = function(n) {
                                return n = c.extend({}, e, n), v.typeCheckConfig("modal", n, t), n
                            }, l.prototype._showElement = function(e) {
                                var s = this,
                                    r = v.supportsTransitionEnd() && c(this._element).hasClass("fade");
                                this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.scrollTop = 0, r && v.reflow(this._element), c(this._element).addClass("in"), this._config.focus && this._enforceFocus();
                                var t = c.Event(u.SHOWN, {
                                        relatedTarget: e
                                    }),
                                    e = function() {
                                        s._config.focus && s._element.focus(), c(s._element).trigger(t)
                                    };
                                r ? c(this._dialog).one(v.TRANSITION_END, e).emulateTransitionEnd(300) : e()
                            }, l.prototype._enforceFocus = function() {
                                var e = this;
                                c(document).off(u.FOCUSIN).on(u.FOCUSIN, function(n) {
                                    document === n.target || e._element === n.target || c(e._element).has(n.target).length || e._element.focus()
                                })
                            }, l.prototype._setEscapeEvent = function() {
                                var e = this;
                                this._isShown && this._config.keyboard ? c(this._element).on(u.KEYDOWN_DISMISS, function(n) {
                                    27 === n.which && e.hide()
                                }) : this._isShown || c(this._element).off(u.KEYDOWN_DISMISS)
                            }, l.prototype._setResizeEvent = function() {
                                this._isShown ? c(window).on(u.RESIZE, c.proxy(this._handleUpdate, this)) : c(window).off(u.RESIZE)
                            }, l.prototype._hideModal = function() {
                                var e = this;
                                this._element.style.display = "none", this._element.setAttribute("aria-hidden", "true"), this._showBackdrop(function() {
                                    c(document.body).removeClass("modal-open"), e._resetAdjustments(), e._resetScrollbar(), c(e._element).trigger(u.HIDDEN)
                                })
                            }, l.prototype._removeBackdrop = function() {
                                this._backdrop && (c(this._backdrop).remove(), this._backdrop = null)
                            }, l.prototype._showBackdrop = function(t) {
                                var o = this,
                                    r = c(this._element).hasClass("fade") ? "fade" : "",
                                    e;
                                this._isShown && this._config.backdrop ? (e = v.supportsTransitionEnd() && r, this._backdrop = document.createElement("div"), this._backdrop.className = "modal-backdrop", r && c(this._backdrop).addClass(r), c(this._backdrop).appendTo(document.body), c(this._element).on(u.CLICK_DISMISS, function(e) {
                                    return o._ignoreBackdropClick ? void(o._ignoreBackdropClick = !1) : void(e.target === e.currentTarget && ("static" === o._config.backdrop ? o._element.focus() : o.hide()))
                                }), e && v.reflow(this._backdrop), c(this._backdrop).addClass("in"), t && (e ? c(this._backdrop).one(v.TRANSITION_END, t).emulateTransitionEnd(150) : t())) : !this._isShown && this._backdrop ? (c(this._backdrop).removeClass("in"), e = function() {
                                    o._removeBackdrop(), t && t()
                                }, v.supportsTransitionEnd() && c(this._element).hasClass("fade") ? c(this._backdrop).one(v.TRANSITION_END, e).emulateTransitionEnd(150) : e()) : t && t()
                            }, l.prototype._handleUpdate = function() {
                                this._adjustDialog()
                            }, l.prototype._adjustDialog = function() {
                                var e = this._element.scrollHeight > document.documentElement.clientHeight;
                                !this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px")
                            }, l.prototype._resetAdjustments = function() {
                                this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
                            }, l.prototype._checkScrollbar = function() {
                                this._isBodyOverflowing = document.body.clientWidth < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth()
                            }, l.prototype._setScrollbar = function() {
                                var e = parseInt(c(s.FIXED_CONTENT).css("padding-right") || 0, 10);
                                this._originalBodyPadding = document.body.style.paddingRight || "", this._isBodyOverflowing && (document.body.style.paddingRight = e + this._scrollbarWidth + "px")
                            }, l.prototype._resetScrollbar = function() {
                                document.body.style.paddingRight = this._originalBodyPadding
                            }, l.prototype._getScrollbarWidth = function() {
                                var t = document.createElement("div");
                                t.className = "modal-scrollbar-measure", document.body.appendChild(t);
                                var n = t.offsetWidth - t.clientWidth;
                                return document.body.removeChild(t), n
                            }, l._jQueryInterface = function(e, t) {
                                return this.each(function() {
                                    var n = c(this).data("bs.modal"),
                                        o = c.extend({}, l.Default, c(this).data(), "object" === (void 0 === e ? "undefined" : y(e)) && e);
                                    if (n || (n = new l(this, o), c(this).data("bs.modal", n)), "string" == typeof e) {
                                        if (void 0 === n[e]) throw new Error("No method named \"" + e + "\"");
                                        n[e](t)
                                    } else o.show && n.show(t)
                                })
                            }, b(l, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }, {
                                key: "Default",
                                get: function() {
                                    return e
                                }
                            }]), l);
                        c(document).on(u.CLICK_DATA_API, s.DATA_TOGGLE, function(r) {
                            var o = this,
                                e = v.getSelectorFromElement(this),
                                i;
                            e && (i = c(e)[0]), e = c(i).data("bs.modal") ? "toggle" : c.extend({}, c(i).data(), c(this).data()), "A" === this.tagName && r.preventDefault();
                            var a = c(i).one(u.SHOW, function(e) {
                                e.isDefaultPrevented() || a.one(u.HIDDEN, function() {
                                    c(o).is(":visible") && o.focus()
                                })
                            });
                            n._jQueryInterface.call(c(i), e, this)
                        }), c.fn.modal = n._jQueryInterface, c.fn.modal.Constructor = n, c.fn.modal.noConflict = function() {
                            return c.fn.modal = o, n._jQueryInterface
                        }
                    }(jQuery),
                    function(s) {
                        function t(r, n) {
                            m(this, t), this._element = r, this._scrollElement = "BODY" === r.tagName ? window : r, this._config = this._getConfig(n), this._selector = this._config.target + " " + i.NAV_LINKS + "," + this._config.target + " " + i.DROPDOWN_ITEMS, this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, s(this._scrollElement).on(o.SCROLL, s.proxy(this._process, this)), this.refresh(), this._process()
                        }
                        var r = s.fn.scrollspy,
                            e = {
                                offset: 10,
                                method: "auto",
                                target: ""
                            },
                            n = {
                                offset: "number",
                                method: "string",
                                target: "(string|element)"
                            },
                            o = {
                                ACTIVATE: "activate.bs.scrollspy",
                                SCROLL: "scroll.bs.scrollspy",
                                LOAD_DATA_API: "load.bs.scrollspy.data-api"
                            },
                            i = {
                                DATA_SPY: "[data-spy=\"scroll\"]",
                                ACTIVE: ".active",
                                LIST_ITEM: ".list-item",
                                LI: "li",
                                LI_DROPDOWN: "li.dropdown",
                                NAV_LINKS: ".nav-link",
                                DROPDOWN: ".dropdown",
                                DROPDOWN_ITEMS: ".dropdown-item",
                                DROPDOWN_TOGGLE: ".dropdown-toggle"
                            },
                            a = (t.prototype.refresh = function() {
                                var e = this,
                                    o = this._scrollElement === this._scrollElement.window ? "offset" : "position",
                                    t = "auto" === this._config.method ? o : this._config.method,
                                    r = "position" === t ? this._getScrollTop() : 0;
                                this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), s.makeArray(s(this._selector)).map(function(e) {
                                    var e = v.getSelectorFromElement(e),
                                        n;
                                    return (n = e ? s(e)[0] : n) && (n.offsetWidth || n.offsetHeight) ? [s(n)[t]().top + r, e] : null
                                }).filter(function(e) {
                                    return e
                                }).sort(function(t, n) {
                                    return t[0] - n[0]
                                }).forEach(function(n) {
                                    e._offsets.push(n[0]), e._targets.push(n[1])
                                })
                            }, t.prototype.dispose = function() {
                                s.removeData(this._element, "bs.scrollspy"), s(this._scrollElement).off(".bs.scrollspy"), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
                            }, t.prototype._getConfig = function(t) {
                                var o;
                                return "string" != typeof(t = s.extend({}, e, t)).target && ((o = s(t.target).attr("id")) || (o = v.getUID("scrollspy"), s(t.target).attr("id", o)), t.target = "#" + o), v.typeCheckConfig("scrollspy", t, n), t
                            }, t.prototype._getScrollTop = function() {
                                return this._scrollElement === window ? this._scrollElement.scrollY : this._scrollElement.scrollTop
                            }, t.prototype._getScrollHeight = function() {
                                return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
                            }, t.prototype._process = function() {
                                var n = this._getScrollTop() + this._config.offset,
                                    o = this._getScrollHeight(),
                                    e = this._config.offset + o - this._scrollElement.offsetHeight;
                                if (this._scrollHeight !== o && this.refresh(), e <= n && (e = this._targets[this._targets.length - 1], this._activeTarget !== e && this._activate(e)), this._activeTarget && n < this._offsets[0]) return this._activeTarget = null, void this._clear();
                                for (var s = this._offsets.length; s--;) this._activeTarget !== this._targets[s] && n >= this._offsets[s] && (void 0 === this._offsets[s + 1] || n < this._offsets[s + 1]) && this._activate(this._targets[s])
                            }, t.prototype._activate = function(e) {
                                this._activeTarget = e, this._clear();
                                var n = (n = this._selector.split(",")).map(function(n) {
                                        return n + "[data-target=\"" + e + "\"]," + n + "[href=\"" + e + "\"]"
                                    }),
                                    n = s(n.join(","));
                                n.hasClass("dropdown-item") ? (n.closest(i.DROPDOWN).find(i.DROPDOWN_TOGGLE).addClass("active"), n.addClass("active")) : n.parents(i.LI).find(i.NAV_LINKS).addClass("active"), s(this._scrollElement).trigger(o.ACTIVATE, {
                                    relatedTarget: e
                                })
                            }, t.prototype._clear = function() {
                                s(this._selector).filter(i.ACTIVE).removeClass("active")
                            }, t._jQueryInterface = function(e) {
                                return this.each(function() {
                                    var o = s(this).data("bs.scrollspy"),
                                        r = "object" === (void 0 === e ? "undefined" : y(e)) && e || null;
                                    if (o || (o = new t(this, r), s(this).data("bs.scrollspy", o)), "string" == typeof e) {
                                        if (void 0 === o[e]) throw new Error("No method named \"" + e + "\"");
                                        o[e]()
                                    }
                                })
                            }, b(t, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }, {
                                key: "Default",
                                get: function() {
                                    return e
                                }
                            }]), t);
                        s(window).on(o.LOAD_DATA_API, function() {
                            for (var t = s.makeArray(s(i.DATA_SPY)), n = t.length, o; n--;) o = s(t[n]), a._jQueryInterface.call(o, o.data())
                        }), s.fn.scrollspy = a._jQueryInterface, s.fn.scrollspy.Constructor = a, s.fn.scrollspy.noConflict = function() {
                            return s.fn.scrollspy = r, a._jQueryInterface
                        }
                    }(jQuery),
                    function(g) {
                        function s(e) {
                            m(this, s), this._element = e
                        }
                        var e = ".bs.tab",
                            n = g.fn.tab,
                            o = {
                                HIDE: "hide" + e,
                                HIDDEN: "hidden" + e,
                                SHOW: "show" + e,
                                SHOWN: "shown" + e,
                                CLICK_DATA_API: "click" + e + ".data-api"
                            },
                            e = "[data-toggle=\"tab\"], [data-toggle=\"pill\"]",
                            i = (s.prototype.show = function() {
                                var t = this,
                                    e, r, n, i, a, l;
                                this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && g(this._element).hasClass("active") || (r = e = void 0, l = g(this._element).closest("ul:not(.dropdown-menu)")[0], n = v.getSelectorFromElement(this._element), l && (r = (r = g.makeArray(g(l).find(".active")))[r.length - 1]), i = g.Event(o.HIDE, {
                                    relatedTarget: this._element
                                }), a = g.Event(o.SHOW, {
                                    relatedTarget: r
                                }), r && g(r).trigger(i), g(this._element).trigger(a), a.isDefaultPrevented() || i.isDefaultPrevented() || (n && (e = g(n)[0]), this._activate(this._element, l), l = function() {
                                    var s = g.Event(o.HIDDEN, {
                                            relatedTarget: t._element
                                        }),
                                        n = g.Event(o.SHOWN, {
                                            relatedTarget: r
                                        });
                                    g(r).trigger(s), g(t._element).trigger(n)
                                }, e ? this._activate(e, e.parentNode, l) : l()))
                            }, s.prototype.dispose = function() {
                                g.removeClass(this._element, "bs.tab"), this._element = null
                            }, s.prototype._activate = function(t, n, o) {
                                var i = g(n).find("> .nav-item > .active, > .active")[0],
                                    n = o && v.supportsTransitionEnd() && (i && g(i).hasClass("fade") || !!g(n).find("> .nav-item .fade, > .fade")[0]),
                                    o = g.proxy(this._transitionComplete, this, t, i, n, o);
                                i && n ? g(i).one(v.TRANSITION_END, o).emulateTransitionEnd(150) : o(), i && g(i).removeClass("in")
                            }, s.prototype._transitionComplete = function(n, o, e, r) {
                                var s;
                                o && (g(o).removeClass("active"), (s = g(o).find("> .dropdown-menu .active")[0]) && g(s).removeClass("active"), o.setAttribute("aria-expanded", !1)), g(n).addClass("active"), n.setAttribute("aria-expanded", !0), e ? (v.reflow(n), g(n).addClass("in")) : g(n).removeClass("fade"), n.parentNode && g(n.parentNode).hasClass("dropdown-menu") && ((e = g(n).closest(".dropdown")[0]) && g(e).find(".dropdown-toggle").addClass("active"), n.setAttribute("aria-expanded", !0)), r && r()
                            }, s._jQueryInterface = function(t) {
                                return this.each(function() {
                                    var o = g(this),
                                        n = o.data("bs.tab");
                                    if (n || (n = new s(this), o.data("bs.tab", n)), "string" == typeof t) {
                                        if (void 0 === n[t]) throw new Error("No method named \"" + t + "\"");
                                        n[t]()
                                    }
                                })
                            }, b(s, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }]), s);
                        g(document).on(o.CLICK_DATA_API, e, function(e) {
                            e.preventDefault(), i._jQueryInterface.call(g(this), "show")
                        }), g.fn.tab = i._jQueryInterface, g.fn.tab.Constructor = i, g.fn.tab.noConflict = function() {
                            return g.fn.tab = n, i._jQueryInterface
                        }
                    }(jQuery), _ = function(s) {
                        function l(t, n) {
                            m(this, l), this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._tether = null, this.element = t, this.config = this._getConfig(n), this.tip = null, this._setListeners()
                        }
                        if (void 0 === window.Tether) throw new Error("Bootstrap tooltips require Tether (http://tether.io/)");
                        var o = s.fn.tooltip,
                            e = {
                                animation: !0,
                                template: "<div class=\"tooltip\" role=\"tooltip\"><div class=\"tooltip-inner\"></div></div>",
                                trigger: "hover focus",
                                title: "",
                                delay: 0,
                                html: !1,
                                selector: !1,
                                placement: "top",
                                offset: "0 0",
                                constraints: []
                            },
                            t = {
                                animation: "boolean",
                                template: "string",
                                title: "(string|element|function)",
                                trigger: "string",
                                delay: "(number|object)",
                                html: "boolean",
                                selector: "(string|boolean)",
                                placement: "(string|function)",
                                offset: "string",
                                constraints: "array"
                            },
                            n = {
                                TOP: "bottom center",
                                RIGHT: "middle left",
                                BOTTOM: "top center",
                                LEFT: "middle right"
                            },
                            r = {
                                HIDE: "hide.bs.tooltip",
                                HIDDEN: "hidden.bs.tooltip",
                                SHOW: "show.bs.tooltip",
                                SHOWN: "shown.bs.tooltip",
                                INSERTED: "inserted.bs.tooltip",
                                CLICK: "click.bs.tooltip",
                                FOCUSIN: "focusin.bs.tooltip",
                                FOCUSOUT: "focusout.bs.tooltip",
                                MOUSEENTER: "mouseenter.bs.tooltip",
                                MOUSELEAVE: "mouseleave.bs.tooltip"
                            },
                            p = {
                                element: !1,
                                enabled: !1
                            },
                            i = (l.prototype.enable = function() {
                                this._isEnabled = !0
                            }, l.prototype.disable = function() {
                                this._isEnabled = !1
                            }, l.prototype.toggleEnabled = function() {
                                this._isEnabled = !this._isEnabled
                            }, l.prototype.toggle = function(t) {
                                var n, o;
                                t ? (n = this.constructor.DATA_KEY, (o = s(t.currentTarget).data(n)) || (o = new this.constructor(t.currentTarget, this._getDelegateConfig()), s(t.currentTarget).data(n, o)), o._activeTrigger.click = !o._activeTrigger.click, o._isWithActiveTrigger() ? o._enter(null, o) : o._leave(null, o)) : s(this.getTipElement()).hasClass("in") ? this._leave(null, this) : this._enter(null, this)
                            }, l.prototype.dispose = function() {
                                clearTimeout(this._timeout), this.cleanupTether(), s.removeData(this.element, this.constructor.DATA_KEY), s(this.element).off(this.constructor.EVENT_KEY), this.tip && s(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, this._activeTrigger = null, this._tether = null, this.element = null, this.config = null, this.tip = null
                            }, l.prototype.show = function() {
                                var e = this,
                                    n = s.Event(this.constructor.Event.SHOW),
                                    o;
                                this.isWithContent() && this._isEnabled && (s(this.element).trigger(n), o = s.contains(this.element.ownerDocument.documentElement, this.element), !n.isDefaultPrevented() && o && (n = this.getTipElement(), o = v.getUID(this.constructor.NAME), n.setAttribute("id", o), this.element.setAttribute("aria-describedby", o), this.setContent(), this.config.animation && s(n).addClass("fade"), o = "function" == typeof this.config.placement ? this.config.placement.call(this, n, this.element) : this.config.placement, o = this._getAttachment(o), s(n).data(this.constructor.DATA_KEY, this).appendTo(document.body), s(this.element).trigger(this.constructor.Event.INSERTED), this._tether = new Tether({
                                    attachment: o,
                                    element: n,
                                    target: this.element,
                                    classes: p,
                                    classPrefix: "bs-tether",
                                    offset: this.config.offset,
                                    constraints: this.config.constraints,
                                    addTargetClasses: !1
                                }), v.reflow(n), this._tether.position(), s(n).addClass("in"), n = function() {
                                    var n = e._hoverState;
                                    e._hoverState = null, s(e.element).trigger(e.constructor.Event.SHOWN), "out" === n && e._leave(null, e)
                                }, v.supportsTransitionEnd() && s(this.tip).hasClass("fade") ? s(this.tip).one(v.TRANSITION_END, n).emulateTransitionEnd(l._TRANSITION_DURATION) : n()))
                            }, l.prototype.hide = function(r) {
                                function o() {
                                    "in" !== e._hoverState && t.parentNode && t.parentNode.removeChild(t), e.element.removeAttribute("aria-describedby"), s(e.element).trigger(e.constructor.Event.HIDDEN), e.cleanupTether(), r && r()
                                }
                                var e = this,
                                    t = this.getTipElement(),
                                    n = s.Event(this.constructor.Event.HIDE);
                                s(this.element).trigger(n), n.isDefaultPrevented() || (s(t).removeClass("in"), v.supportsTransitionEnd() && s(this.tip).hasClass("fade") ? s(t).one(v.TRANSITION_END, o).emulateTransitionEnd(150) : o(), this._hoverState = "")
                            }, l.prototype.isWithContent = function() {
                                return !!this.getTitle()
                            }, l.prototype.getTipElement = function() {
                                return this.tip = this.tip || s(this.config.template)[0]
                            }, l.prototype.setContent = function() {
                                var e = s(this.getTipElement());
                                this.setElementContent(e.find(".tooltip-inner"), this.getTitle()), e.removeClass("fade").removeClass("in"), this.cleanupTether()
                            }, l.prototype.setElementContent = function(n, o) {
                                var e = this.config.html;
                                "object" === (void 0 === o ? "undefined" : y(o)) && (o.nodeType || o.jquery) ? e ? s(o).parent().is(n) || n.empty().append(o) : n.text(s(o).text()): n[e ? "html" : "text"](o)
                            }, l.prototype.getTitle = function() {
                                return this.element.getAttribute("data-original-title") || ("function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title)
                            }, l.prototype.cleanupTether = function() {
                                this._tether && this._tether.destroy()
                            }, l.prototype._getAttachment = function(e) {
                                return n[e.toUpperCase()]
                            }, l.prototype._setListeners = function() {
                                var e = this;
                                this.config.trigger.split(" ").forEach(function(t) {
                                    var o;
                                    "click" === t ? s(e.element).on(e.constructor.Event.CLICK, e.config.selector, s.proxy(e.toggle, e)) : "manual" !== t && (o = "hover" === t ? e.constructor.Event.MOUSEENTER : e.constructor.Event.FOCUSIN, t = "hover" === t ? e.constructor.Event.MOUSELEAVE : e.constructor.Event.FOCUSOUT, s(e.element).on(o, e.config.selector, s.proxy(e._enter, e)).on(t, e.config.selector, s.proxy(e._leave, e)))
                                }), this.config.selector ? this.config = s.extend({}, this.config, {
                                    trigger: "manual",
                                    selector: ""
                                }) : this._fixTitle()
                            }, l.prototype._fixTitle = function() {
                                var e = y(this.element.getAttribute("data-original-title"));
                                (this.element.getAttribute("title") || "string" !== e) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
                            }, l.prototype._enter = function(t, n) {
                                var o = this.constructor.DATA_KEY;
                                return (n = n || s(t.currentTarget).data(o)) || (n = new this.constructor(t.currentTarget, this._getDelegateConfig()), s(t.currentTarget).data(o, n)), t && (n._activeTrigger["focusin" === t.type ? "focus" : "hover"] = !0), s(n.getTipElement()).hasClass("in") || "in" === n._hoverState ? void(n._hoverState = "in") : (clearTimeout(n._timeout), n._hoverState = "in", n.config.delay && n.config.delay.show ? void(n._timeout = setTimeout(function() {
                                    "in" === n._hoverState && n.show()
                                }, n.config.delay.show)) : void n.show())
                            }, l.prototype._leave = function(t, n) {
                                var o = this.constructor.DATA_KEY;
                                if ((n = n || s(t.currentTarget).data(o)) || (n = new this.constructor(t.currentTarget, this._getDelegateConfig()), s(t.currentTarget).data(o, n)), t && (n._activeTrigger["focusout" === t.type ? "focus" : "hover"] = !1), !n._isWithActiveTrigger()) return clearTimeout(n._timeout), n._hoverState = "out", n.config.delay && n.config.delay.hide ? void(n._timeout = setTimeout(function() {
                                    "out" === n._hoverState && n.hide()
                                }, n.config.delay.hide)) : void n.hide()
                            }, l.prototype._isWithActiveTrigger = function() {
                                for (var e in this._activeTrigger)
                                    if (this._activeTrigger[e]) return !0;
                                return !1
                            }, l.prototype._getConfig = function(e) {
                                return (e = s.extend({}, this.constructor.Default, s(this.element).data(), e)).delay && "number" == typeof e.delay && (e.delay = {
                                    show: e.delay,
                                    hide: e.delay
                                }), v.typeCheckConfig("tooltip", e, this.constructor.DefaultType), e
                            }, l.prototype._getDelegateConfig = function() {
                                var t = {};
                                if (this.config)
                                    for (var n in this.config) this.constructor.Default[n] !== this.config[n] && (t[n] = this.config[n]);
                                return t
                            }, l._jQueryInterface = function(e) {
                                return this.each(function() {
                                    var t = s(this).data("bs.tooltip"),
                                        o = "object" === (void 0 === e ? "undefined" : y(e)) ? e : null;
                                    if ((t || !/dispose|hide/.test(e)) && (t || (t = new l(this, o), s(this).data("bs.tooltip", t)), "string" == typeof e)) {
                                        if (void 0 === t[e]) throw new Error("No method named \"" + e + "\"");
                                        t[e]()
                                    }
                                })
                            }, b(l, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }, {
                                key: "Default",
                                get: function() {
                                    return e
                                }
                            }, {
                                key: "NAME",
                                get: function() {
                                    return "tooltip"
                                }
                            }, {
                                key: "DATA_KEY",
                                get: function() {
                                    return "bs.tooltip"
                                }
                            }, {
                                key: "Event",
                                get: function() {
                                    return r
                                }
                            }, {
                                key: "EVENT_KEY",
                                get: function() {
                                    return ".bs.tooltip"
                                }
                            }, {
                                key: "DefaultType",
                                get: function() {
                                    return t
                                }
                            }]), l);
                        return s.fn.tooltip = i._jQueryInterface, s.fn.tooltip.Constructor = i, s.fn.tooltip.noConflict = function() {
                            return s.fn.tooltip = o, i._jQueryInterface
                        }, i
                    }(jQuery),
                    function(e) {
                        function r() {
                            return m(this, r),
                                function(t, n) {
                                    if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                                    return n && ("object" == typeof n || "function" == typeof n) ? n : t
                                }(this, a.apply(this, arguments))
                        }
                        var s = e.fn.popover,
                            t = e.extend({}, _.Default, {
                                placement: "right",
                                trigger: "click",
                                content: "",
                                template: "<div class=\"popover\" role=\"tooltip\"><h3 class=\"popover-title\"></h3><div class=\"popover-content\"></div></div>"
                            }),
                            n = e.extend({}, _.DefaultType, {
                                content: "(string|element|function)"
                            }),
                            o = {
                                HIDE: "hide.bs.popover",
                                HIDDEN: "hidden.bs.popover",
                                SHOW: "show.bs.popover",
                                SHOWN: "shown.bs.popover",
                                INSERTED: "inserted.bs.popover",
                                CLICK: "click.bs.popover",
                                FOCUSIN: "focusin.bs.popover",
                                FOCUSOUT: "focusout.bs.popover",
                                MOUSEENTER: "mouseenter.bs.popover",
                                MOUSELEAVE: "mouseleave.bs.popover"
                            },
                            i = (function(t, n) {
                                if ("function" != typeof n && null !== n) throw new TypeError("Super expression must either be null or a function, not " + typeof n);
                                t.prototype = Object.create(n && n.prototype, {
                                    constructor: {
                                        value: t,
                                        enumerable: !1,
                                        writable: !0,
                                        configurable: !0
                                    }
                                }), n && (Object.setPrototypeOf ? Object.setPrototypeOf(t, n) : t.__proto__ = n)
                            }(r, a = _), r.prototype.isWithContent = function() {
                                return this.getTitle() || this._getContent()
                            }, r.prototype.getTipElement = function() {
                                return this.tip = this.tip || e(this.config.template)[0]
                            }, r.prototype.setContent = function() {
                                var n = e(this.getTipElement());
                                this.setElementContent(n.find(".popover-title"), this.getTitle()), this.setElementContent(n.find(".popover-content"), this._getContent()), n.removeClass("fade").removeClass("in"), this.cleanupTether()
                            }, r.prototype._getContent = function() {
                                return this.element.getAttribute("data-content") || ("function" == typeof this.config.content ? this.config.content.call(this.element) : this.config.content)
                            }, r._jQueryInterface = function(t) {
                                return this.each(function() {
                                    var o = e(this).data("bs.popover"),
                                        i = "object" === (void 0 === t ? "undefined" : y(t)) ? t : null;
                                    if ((o || !/destroy|hide/.test(t)) && (o || (o = new r(this, i), e(this).data("bs.popover", o)), "string" == typeof t)) {
                                        if (void 0 === o[t]) throw new Error("No method named \"" + t + "\"");
                                        o[t]()
                                    }
                                })
                            }, b(r, null, [{
                                key: "VERSION",
                                get: function() {
                                    return "4.0.0-alpha.5"
                                }
                            }, {
                                key: "Default",
                                get: function() {
                                    return t
                                }
                            }, {
                                key: "NAME",
                                get: function() {
                                    return "popover"
                                }
                            }, {
                                key: "DATA_KEY",
                                get: function() {
                                    return "bs.popover"
                                }
                            }, {
                                key: "Event",
                                get: function() {
                                    return o
                                }
                            }, {
                                key: "EVENT_KEY",
                                get: function() {
                                    return ".bs.popover"
                                }
                            }, {
                                key: "DefaultType",
                                get: function() {
                                    return n
                                }
                            }]), r),
                            a;
                        e.fn.popover = i._jQueryInterface, e.fn.popover.Constructor = i, e.fn.popover.noConflict = function() {
                            return e.fn.popover = s, i._jQueryInterface
                        }
                    }(jQuery)
            },
            590: e => {
                function n() {
                    this._events = this._events || {}, this._maxListeners = this._maxListeners || void 0
                }

                function i(e) {
                    return "function" == typeof e
                }

                function o(e) {
                    return "object" == typeof e && null !== e
                }

                function s(e) {
                    return void 0 === e
                }((e.exports = n).EventEmitter = n).prototype._events = void 0, n.prototype._maxListeners = void 0, n.defaultMaxListeners = 10, n.prototype.setMaxListeners = function(e) {
                    if ("number" != typeof e || 0 > e || isNaN(e)) throw TypeError("n must be a positive number");
                    return this._maxListeners = e, this
                }, n.prototype.emit = function(t) {
                    var n, r, a, l, d, p;
                    if (this._events || (this._events = {}), "error" === t && (!this._events.error || o(this._events.error) && !this._events.error.length)) {
                        if ((n = arguments[1]) instanceof Error) throw n;
                        var c = new Error("Uncaught, unspecified \"error\" event. (" + n + ")");
                        throw c.context = n, c
                    }
                    if (s(r = this._events[t])) return !1;
                    if (i(r)) switch (arguments.length) {
                        case 1:
                            r.call(this);
                            break;
                        case 2:
                            r.call(this, arguments[1]);
                            break;
                        case 3:
                            r.call(this, arguments[1], arguments[2]);
                            break;
                        default:
                            l = Array.prototype.slice.call(arguments, 1), r.apply(this, l);
                    } else if (o(r))
                        for (l = Array.prototype.slice.call(arguments, 1), a = (p = r.slice()).length, d = 0; d < a; d++) p[d].apply(this, l);
                    return !0
                }, n.prototype.on = n.prototype.addListener = function(a, r) {
                    var e;
                    if (!i(r)) throw TypeError("listener must be a function");
                    return this._events || (this._events = {}), this._events.newListener && this.emit("newListener", a, i(r.listener) ? r.listener : r), this._events[a] ? o(this._events[a]) ? this._events[a].push(r) : this._events[a] = [this._events[a], r] : this._events[a] = r, o(this._events[a]) && !this._events[a].warned && (e = s(this._maxListeners) ? n.defaultMaxListeners : this._maxListeners) && 0 < e && this._events[a].length > e && (this._events[a].warned = !0, console.trace), this
                }, n.prototype.once = function(n, o) {
                    function e() {
                        this.removeListener(n, e), t || (t = !0, o.apply(this, arguments))
                    }
                    if (!i(o)) throw TypeError("listener must be a function");
                    var t = !1;
                    return e.listener = o, this.on(n, e), this
                }, n.prototype.removeListener = function(n, r) {
                    var e, s, l, d;
                    if (!i(r)) throw TypeError("listener must be a function");
                    if (!this._events || !this._events[n]) return this;
                    if (l = (e = this._events[n]).length, s = -1, e === r || i(e.listener) && e.listener === r) delete this._events[n], this._events.removeListener && this.emit("removeListener", n, r);
                    else if (o(e)) {
                        for (d = l; 0 < d--;)
                            if (e[d] === r || e[d].listener && e[d].listener === r) {
                                s = d;
                                break
                            }
                        if (0 > s) return this;
                        1 === e.length ? (e.length = 0, delete this._events[n]) : e.splice(s, 1), this._events.removeListener && this.emit("removeListener", n, r)
                    }
                    return this
                }, n.prototype.removeAllListeners = function(t) {
                    var n, o;
                    if (!this._events) return this;
                    if (!this._events.removeListener) return 0 === arguments.length ? this._events = {} : this._events[t] && delete this._events[t], this;
                    if (0 === arguments.length) {
                        for (n in this._events) "removeListener" !== n && this.removeAllListeners(n);
                        return this.removeAllListeners("removeListener"), this._events = {}, this
                    }
                    if (i(o = this._events[t])) this.removeListener(t, o);
                    else if (o)
                        for (; o.length;) this.removeListener(t, o[o.length - 1]);
                    return delete this._events[t], this
                }, n.prototype.listeners = function(e) {
                    return e = this._events && this._events[e] ? i(this._events[e]) ? [this._events[e]] : this._events[e].slice() : [], e
                }, n.prototype.listenerCount = function(e) {
                    if (this._events) {
                        if (e = this._events[e], i(e)) return 1;
                        if (e) return e.length
                    }
                    return 0
                }, n.listenerCount = function(t, n) {
                    return t.listenerCount(n)
                }
            },
            635: e => {
                e.exports = function n(d, i, r) {
                    function o(t) {
                        if (!i[t]) {
                            if (!d[t]) {
                                if (0, s) return s(t, !0);
                                var a = new Error("Cannot find module '" + t + "'");
                                throw a.code = "MODULE_NOT_FOUND", a
                            }
                            a = i[t] = {
                                exports: {}
                            }, d[t][0].call(a.exports, function(r) {
                                var n = d[t][1][r];
                                return o(n || r)
                            }, a, a.exports, n, d, i, r)
                        }
                        return i[t].exports
                    }
                    for (var e = 0, s; e < r.length; e++) o(r[e]);
                    return o
                }({
                    1: [function(t, n) {
                        n.exports = function(t) {
                            var n = -1,
                                o, r, i;
                            if (1 < t.lines.length && "flex-start" === t.style.alignContent)
                                for (o = 0; i = t.lines[++n];) i.crossStart = o, o += i.cross;
                            else if (1 < t.lines.length && "flex-end" === t.style.alignContent)
                                for (o = t.flexStyle.crossSpace; i = t.lines[++n];) i.crossStart = o, o += i.cross;
                            else if (1 < t.lines.length && "center" === t.style.alignContent)
                                for (o = t.flexStyle.crossSpace / 2; i = t.lines[++n];) i.crossStart = o, o += i.cross;
                            else if (1 < t.lines.length && "space-between" === t.style.alignContent)
                                for (r = t.flexStyle.crossSpace / (t.lines.length - 1), o = 0; i = t.lines[++n];) i.crossStart = o, o += i.cross + r;
                            else if (1 < t.lines.length && "space-around" === t.style.alignContent)
                                for (o = (r = 2 * t.flexStyle.crossSpace / (2 * t.lines.length)) / 2; i = t.lines[++n];) i.crossStart = o, o += i.cross + r;
                            else
                                for (r = t.flexStyle.crossSpace / t.lines.length, o = t.flexStyle.crossInnerBefore; i = t.lines[++n];) i.crossStart = o, i.cross += r, o += i.cross
                        }
                    }, {}],
                    2: [function(t, n) {
                        n.exports = function(t) {
                            for (var n = -1, o; line = t.lines[++n];)
                                for (o = -1; child = line.children[++o];) {
                                    var i = child.style.alignSelf;
                                    "flex-start" === (i = "auto" === i ? t.style.alignItems : i) ? child.flexStyle.crossStart = line.crossStart: "flex-end" === i ? child.flexStyle.crossStart = line.crossStart + line.cross - child.flexStyle.crossOuter : "center" === i ? child.flexStyle.crossStart = line.crossStart + (line.cross - child.flexStyle.crossOuter) / 2 : (child.flexStyle.crossStart = line.crossStart, child.flexStyle.crossOuter = line.cross, child.flexStyle.cross = child.flexStyle.crossOuter - child.flexStyle.crossBefore - child.flexStyle.crossAfter)
                                }
                        }
                    }, {}],
                    3: [function(t, n) {
                        n.exports = function(r, o) {
                            var e = "row" === o || "row-reverse" === o,
                                t = r.mainAxis;
                            t ? e && "inline" === t || !e && "block" === t || (r.flexStyle = {
                                main: r.flexStyle.cross,
                                cross: r.flexStyle.main,
                                mainOffset: r.flexStyle.crossOffset,
                                crossOffset: r.flexStyle.mainOffset,
                                mainBefore: r.flexStyle.crossBefore,
                                mainAfter: r.flexStyle.crossAfter,
                                crossBefore: r.flexStyle.mainBefore,
                                crossAfter: r.flexStyle.mainAfter,
                                mainInnerBefore: r.flexStyle.crossInnerBefore,
                                mainInnerAfter: r.flexStyle.crossInnerAfter,
                                crossInnerBefore: r.flexStyle.mainInnerBefore,
                                crossInnerAfter: r.flexStyle.mainInnerAfter,
                                mainBorderBefore: r.flexStyle.crossBorderBefore,
                                mainBorderAfter: r.flexStyle.crossBorderAfter,
                                crossBorderBefore: r.flexStyle.mainBorderBefore,
                                crossBorderAfter: r.flexStyle.mainBorderAfter
                            }) : (r.flexStyle = e ? {
                                main: r.style.width,
                                cross: r.style.height,
                                mainOffset: r.style.offsetWidth,
                                crossOffset: r.style.offsetHeight,
                                mainBefore: r.style.marginLeft,
                                mainAfter: r.style.marginRight,
                                crossBefore: r.style.marginTop,
                                crossAfter: r.style.marginBottom,
                                mainInnerBefore: r.style.paddingLeft,
                                mainInnerAfter: r.style.paddingRight,
                                crossInnerBefore: r.style.paddingTop,
                                crossInnerAfter: r.style.paddingBottom,
                                mainBorderBefore: r.style.borderLeftWidth,
                                mainBorderAfter: r.style.borderRightWidth,
                                crossBorderBefore: r.style.borderTopWidth,
                                crossBorderAfter: r.style.borderBottomWidth
                            } : {
                                main: r.style.height,
                                cross: r.style.width,
                                mainOffset: r.style.offsetHeight,
                                crossOffset: r.style.offsetWidth,
                                mainBefore: r.style.marginTop,
                                mainAfter: r.style.marginBottom,
                                crossBefore: r.style.marginLeft,
                                crossAfter: r.style.marginRight,
                                mainInnerBefore: r.style.paddingTop,
                                mainInnerAfter: r.style.paddingBottom,
                                crossInnerBefore: r.style.paddingLeft,
                                crossInnerAfter: r.style.paddingRight,
                                mainBorderBefore: r.style.borderTopWidth,
                                mainBorderAfter: r.style.borderBottomWidth,
                                crossBorderBefore: r.style.borderLeftWidth,
                                crossBorderAfter: r.style.borderRightWidth
                            }, "content-box" === r.style.boxSizing && ("number" == typeof r.flexStyle.main && (r.flexStyle.main += r.flexStyle.mainInnerBefore + r.flexStyle.mainInnerAfter + r.flexStyle.mainBorderBefore + r.flexStyle.mainBorderAfter), "number" == typeof r.flexStyle.cross && (r.flexStyle.cross += r.flexStyle.crossInnerBefore + r.flexStyle.crossInnerAfter + r.flexStyle.crossBorderBefore + r.flexStyle.crossBorderAfter))), r.mainAxis = e ? "inline" : "block", r.crossAxis = e ? "block" : "inline", "number" == typeof r.style.flexBasis && (r.flexStyle.main = r.style.flexBasis + r.flexStyle.mainInnerBefore + r.flexStyle.mainInnerAfter + r.flexStyle.mainBorderBefore + r.flexStyle.mainBorderAfter), r.flexStyle.mainOuter = r.flexStyle.main, r.flexStyle.crossOuter = r.flexStyle.cross, "auto" === r.flexStyle.mainOuter && (r.flexStyle.mainOuter = r.flexStyle.mainOffset), "auto" === r.flexStyle.crossOuter && (r.flexStyle.crossOuter = r.flexStyle.crossOffset), "number" == typeof r.flexStyle.mainBefore && (r.flexStyle.mainOuter += r.flexStyle.mainBefore), "number" == typeof r.flexStyle.mainAfter && (r.flexStyle.mainOuter += r.flexStyle.mainAfter), "number" == typeof r.flexStyle.crossBefore && (r.flexStyle.crossOuter += r.flexStyle.crossBefore), "number" == typeof r.flexStyle.crossAfter && (r.flexStyle.crossOuter += r.flexStyle.crossAfter)
                        }
                    }, {}],
                    4: [function(o, n) {
                        var e = o("../reduce");
                        n.exports = function(t) {
                            var o;
                            0 < t.mainSpace && 0 < (o = e(t.children, function(t, n) {
                                return t + parseFloat(n.style.flexGrow)
                            }, 0)) && (t.main = e(t.children, function(n, r) {
                                return "auto" === r.flexStyle.main ? r.flexStyle.main = r.flexStyle.mainOffset + parseFloat(r.style.flexGrow) / o * t.mainSpace : r.flexStyle.main += parseFloat(r.style.flexGrow) / o * t.mainSpace, r.flexStyle.mainOuter = r.flexStyle.main + r.flexStyle.mainBefore + r.flexStyle.mainAfter, n + r.flexStyle.mainOuter
                            }, 0), t.mainSpace = 0)
                        }
                    }, {
                        "../reduce": 12
                    }],
                    5: [function(o, n) {
                        var e = o("../reduce");
                        n.exports = function(t) {
                            var o;
                            0 > t.mainSpace && 0 < (o = e(t.children, function(t, n) {
                                return t + parseFloat(n.style.flexShrink)
                            }, 0)) && (t.main = e(t.children, function(n, r) {
                                return r.flexStyle.main += parseFloat(r.style.flexShrink) / o * t.mainSpace, r.flexStyle.mainOuter = r.flexStyle.main + r.flexStyle.mainBefore + r.flexStyle.mainAfter, n + r.flexStyle.mainOuter
                            }, 0), t.mainSpace = 0)
                        }
                    }, {
                        "../reduce": 12
                    }],
                    6: [function(t, n) {
                        var i = t("../reduce");
                        n.exports = function(t) {
                            var n;
                            t.lines = [n = {
                                main: 0,
                                cross: 0,
                                children: []
                            }];
                            for (var o = -1, r; r = t.children[++o];) "nowrap" === t.style.flexWrap || 0 === n.children.length || "auto" === t.flexStyle.main || t.flexStyle.main - t.flexStyle.mainInnerBefore - t.flexStyle.mainInnerAfter - t.flexStyle.mainBorderBefore - t.flexStyle.mainBorderAfter >= n.main + r.flexStyle.mainOuter ? (n.main += r.flexStyle.mainOuter, n.cross = Math.max(n.cross, r.flexStyle.crossOuter)) : t.lines.push(n = {
                                main: r.flexStyle.mainOuter,
                                cross: r.flexStyle.crossOuter,
                                children: []
                            }), n.children.push(r);
                            t.flexStyle.mainLines = i(t.lines, function(t, n) {
                                return Math.max(t, n.main)
                            }, 0), t.flexStyle.crossLines = i(t.lines, function(t, n) {
                                return t + n.cross
                            }, 0), "auto" === t.flexStyle.main && (t.flexStyle.main = Math.max(t.flexStyle.mainOffset, t.flexStyle.mainLines + t.flexStyle.mainInnerBefore + t.flexStyle.mainInnerAfter + t.flexStyle.mainBorderBefore + t.flexStyle.mainBorderAfter)), "auto" === t.flexStyle.cross && (t.flexStyle.cross = Math.max(t.flexStyle.crossOffset, t.flexStyle.crossLines + t.flexStyle.crossInnerBefore + t.flexStyle.crossInnerAfter + t.flexStyle.crossBorderBefore + t.flexStyle.crossBorderAfter)), t.flexStyle.crossSpace = t.flexStyle.cross - t.flexStyle.crossInnerBefore - t.flexStyle.crossInnerAfter - t.flexStyle.crossBorderBefore - t.flexStyle.crossBorderAfter - t.flexStyle.crossLines, t.flexStyle.mainOuter = t.flexStyle.main + t.flexStyle.mainBefore + t.flexStyle.mainAfter, t.flexStyle.crossOuter = t.flexStyle.cross + t.flexStyle.crossBefore + t.flexStyle.crossAfter
                        }
                    }, {
                        "../reduce": 12
                    }],
                    7: [function(n, e) {
                        e.exports = function(t) {
                            for (var o = -1, r, i; r = t.children[++o];) n("./flex-direction")(r, t.style.flexDirection);
                            for (n("./flex-direction")(t, t.style.flexDirection), n("./order")(t), n("./flexbox-lines")(t), n("./align-content")(t), o = -1; i = t.lines[++o];) i.mainSpace = t.flexStyle.main - t.flexStyle.mainInnerBefore - t.flexStyle.mainInnerAfter - t.flexStyle.mainBorderBefore - t.flexStyle.mainBorderAfter - i.main, n("./flex-grow")(i), n("./flex-shrink")(i), n("./margin-main")(i), n("./margin-cross")(i), n("./justify-content")(i, t.style.justifyContent, t);
                            n("./align-items")(t)
                        }
                    }, {
                        "./align-content": 1,
                        "./align-items": 2,
                        "./flex-direction": 3,
                        "./flex-grow": 4,
                        "./flex-shrink": 5,
                        "./flexbox-lines": 6,
                        "./justify-content": 8,
                        "./margin-cross": 9,
                        "./margin-main": 10,
                        "./order": 11
                    }],
                    8: [function(t, n) {
                        n.exports = function(n, o, e) {
                            var e = e.flexStyle.mainInnerBefore,
                                r = -1,
                                s, i, a;
                            if ("flex-end" === o)
                                for (s = n.mainSpace, s += e; a = n.children[++r];) a.flexStyle.mainStart = s, s += a.flexStyle.mainOuter;
                            else if ("center" === o)
                                for (s = n.mainSpace / 2, s += e; a = n.children[++r];) a.flexStyle.mainStart = s, s += a.flexStyle.mainOuter;
                            else if ("space-between" === o)
                                for (i = n.mainSpace / (n.children.length - 1), s = 0, s += e; a = n.children[++r];) a.flexStyle.mainStart = s, s += a.flexStyle.mainOuter + i;
                            else if ("space-around" === o)
                                for (s = (i = 2 * n.mainSpace / (2 * n.children.length)) / 2, s += e; a = n.children[++r];) a.flexStyle.mainStart = s, s += a.flexStyle.mainOuter + i;
                            else
                                for (s = 0, s += e; a = n.children[++r];) a.flexStyle.mainStart = s, s += a.flexStyle.mainOuter
                        }
                    }, {}],
                    9: [function(t, n) {
                        n.exports = function(t) {
                            for (var n = -1, o, r; o = t.children[++n];) {
                                r = 0, "auto" === o.flexStyle.crossBefore && ++r, "auto" === o.flexStyle.crossAfter && ++r;
                                var i = t.cross - o.flexStyle.crossOuter;
                                "auto" === o.flexStyle.crossBefore && (o.flexStyle.crossBefore = i / r), "auto" === o.flexStyle.crossAfter && (o.flexStyle.crossAfter = i / r), o.flexStyle.crossOuter = "auto" === o.flexStyle.cross ? o.flexStyle.crossOffset + o.flexStyle.crossBefore + o.flexStyle.crossAfter : o.flexStyle.cross + o.flexStyle.crossBefore + o.flexStyle.crossAfter
                            }
                        }
                    }, {}],
                    10: [function(t, n) {
                        n.exports = function(t) {
                            for (var n = 0, o = -1, i; i = t.children[++o];) "auto" === i.flexStyle.mainBefore && ++n, "auto" === i.flexStyle.mainAfter && ++n;
                            if (0 < n) {
                                for (o = -1; i = t.children[++o];) "auto" === i.flexStyle.mainBefore && (i.flexStyle.mainBefore = t.mainSpace / n), "auto" === i.flexStyle.mainAfter && (i.flexStyle.mainAfter = t.mainSpace / n), i.flexStyle.mainOuter = "auto" === i.flexStyle.main ? i.flexStyle.mainOffset + i.flexStyle.mainBefore + i.flexStyle.mainAfter : i.flexStyle.main + i.flexStyle.mainBefore + i.flexStyle.mainAfter;
                                t.mainSpace = 0
                            }
                        }
                    }, {}],
                    11: [function(t, n) {
                        n.exports = function(e) {
                            e.children.sort(function(t, n) {
                                return t.style.order - n.style.order || t.index - n.index
                            }), /^(column|row)-reverse$/.test(e.style.flexDirection) && e.children.reverse()
                        }
                    }, {}],
                    12: [function(t, n) {
                        n.exports = function(n, o, e) {
                            for (var r = n.length, s = -1; ++s < r;) s in n && (e = o(e, n[s], s));
                            return e
                        }
                    }, {}],
                    13: [function(s, n) {
                        var e = s("./read"),
                            t = s("./write"),
                            i = s("./readAll"),
                            r = s("./writeAll");
                        n.exports = function(e) {
                            r(i(e))
                        }, n.exports.read = e, n.exports.write = t, n.exports.readAll = i, n.exports.writeAll = r
                    }, {
                        "./read": 15,
                        "./readAll": 16,
                        "./write": 17,
                        "./writeAll": 18
                    }],
                    14: [function(t, n) {
                        n.exports = function(n, o) {
                            var r = (n + "").match(i);
                            if (!r) return n;
                            var s = r[1];
                            return "px" === (r = r[2]) ? +s : "cm" === r ? 96 * (.3937 * s) : "in" === r ? 96 * s : "mm" === r ? 96 * (.3937 * s) / 10 : "pc" === r ? 96 * (12 * s) / 72 : "pt" === r ? 96 * s / 72 : "rem" === r ? 16 * s : function(t, r) {
                                return e.style.cssText = "border:none!important;clip:rect(0 0 0 0)!important;display:block!important;font-size:1em!important;height:0!important;margin:0!important;padding:0!important;position:relative!important;width:" + t + "!important", r.parentNode.insertBefore(e, r.nextSibling), t = e.offsetWidth, r.parentNode.removeChild(e), t
                            }(n, o)
                        };
                        var i = /^([-+]?\d*\.?\d+)(%|[a-z]+)$/,
                            e = document.createElement("div")
                    }, {}],
                    15: [function(t, n) {
                        n.exports = function(n) {
                            var o = {
                                alignContent: "stretch",
                                alignItems: "stretch",
                                alignSelf: "auto",
                                borderBottomWidth: 0,
                                borderLeftWidth: 0,
                                borderRightWidth: 0,
                                borderTopWidth: 0,
                                boxSizing: "content-box",
                                display: "inline",
                                flexBasis: "auto",
                                flexDirection: "row",
                                flexGrow: 0,
                                flexShrink: 1,
                                flexWrap: "nowrap",
                                justifyContent: "flex-start",
                                height: "auto",
                                marginTop: 0,
                                marginRight: 0,
                                marginLeft: 0,
                                marginBottom: 0,
                                paddingTop: 0,
                                paddingRight: 0,
                                paddingLeft: 0,
                                paddingBottom: 0,
                                maxHeight: "none",
                                maxWidth: "none",
                                minHeight: 0,
                                minWidth: 0,
                                order: 0,
                                position: "static",
                                width: "auto"
                            };
                            if (n instanceof Element) {
                                var e = n.hasAttribute("data-style"),
                                    t = e ? n.getAttribute("data-style") : n.getAttribute("style") || "",
                                    s;
                                for (s in e || n.setAttribute("data-style", t), function(n, o) {
                                        for (var e in n) e in o && !/^(alignSelf|height|width)$/.test(e) && (n[e] = o[e])
                                    }(o, window.getComputedStyle && getComputedStyle(n) || {}), function(r, o) {
                                        for (var e in r) {
                                            var t;
                                            e in o ? r[e] = o[e] : (t = e.replace(/[A-Z]/g, "-$&").toLowerCase()) in o && (r[e] = o[t])
                                        }
                                        "-js-display" in o && (r.display = o["-js-display"])
                                    }(o, n.currentStyle || {}), function(n, o) {
                                        for (var e, r; e = i.exec(o);) r = e[1].toLowerCase().replace(/-[a-z]/g, function(e) {
                                            return e.slice(1).toUpperCase()
                                        }), n[r] = e[2]
                                    }(o, t), o) o[s] = r(o[s], n);
                                t = n.getBoundingClientRect(), o.offsetHeight = t.height || n.offsetHeight, o.offsetWidth = t.width || n.offsetWidth
                            }
                            return {
                                element: n,
                                style: o
                            }
                        };
                        var i = /([^\s:;]+)\s*:\s*([^;]+?)\s*(;|$)/g,
                            r = t("./getComputedLength")
                    }, {
                        "./getComputedLength": 14
                    }],
                    16: [function(t, n) {
                        function s(n) {
                            var i = n instanceof Element,
                                s = i && n.getAttribute("data-style"),
                                n = i && n.currentStyle && n.currentStyle["-js-display"];
                            return e.test(s) || o.test(n)
                        }
                        n.exports = function(t) {
                            var n = [];
                            return function i(l, e) {
                                for (var t = s(l), n = [], r = -1, d, p; d = l.childNodes[++r];) {
                                    p = 3 === d.nodeType && !/^\s*$/.test(d.nodeValue), t && p && (c = d, (d = l.insertBefore(document.createElement("flex-item"), c)).appendChild(c));
                                    var p = d instanceof Element,
                                        c;
                                    p && (c = i(d, e), t && ((p = d.style).display = "inline-block", p.position = "absolute", c.style = a(d).style, n.push(c)))
                                }
                                var u = {
                                    element: l,
                                    children: n
                                };
                                return t && (u.style = a(l).style, e.push(u)), u
                            }(t, n), n
                        };
                        var a = t("../read"),
                            e = /(^|;)\s*display\s*:\s*(inline-)?flex\s*(;|$)/i,
                            o = /^(inline-)?flex$/i
                    }, {
                        "../read": 15
                    }],
                    17: [function(t, n) {
                        function r(e) {
                            return "string" == typeof e ? e : Math.max(e, 0) + "px"
                        }
                        n.exports = function(i) {
                            s(i);
                            var a = i.element.style,
                                e = "inline" === i.mainAxis ? ["main", "cross"] : ["cross", "main"];
                            a.boxSizing = "content-box", a.display = "block", a.position = "relative", a.width = r(i.flexStyle[e[0]] - i.flexStyle[e[0] + "InnerBefore"] - i.flexStyle[e[0] + "InnerAfter"] - i.flexStyle[e[0] + "BorderBefore"] - i.flexStyle[e[0] + "BorderAfter"]), a.height = r(i.flexStyle[e[1]] - i.flexStyle[e[1] + "InnerBefore"] - i.flexStyle[e[1] + "InnerAfter"] - i.flexStyle[e[1] + "BorderBefore"] - i.flexStyle[e[1] + "BorderAfter"]);
                            for (var t = -1, l; l = i.children[++t];) {
                                var d = l.element.style,
                                    c = "inline" === l.mainAxis ? ["main", "cross"] : ["cross", "main"];
                                d.boxSizing = "content-box", d.display = "block", d.position = "absolute", "auto" !== l.flexStyle[c[0]] && (d.width = r(l.flexStyle[c[0]] - l.flexStyle[c[0] + "InnerBefore"] - l.flexStyle[c[0] + "InnerAfter"] - l.flexStyle[c[0] + "BorderBefore"] - l.flexStyle[c[0] + "BorderAfter"])), "auto" !== l.flexStyle[c[1]] && (d.height = r(l.flexStyle[c[1]] - l.flexStyle[c[1] + "InnerBefore"] - l.flexStyle[c[1] + "InnerAfter"] - l.flexStyle[c[1] + "BorderBefore"] - l.flexStyle[c[1] + "BorderAfter"])), d.top = r(l.flexStyle[c[1] + "Start"]), d.left = r(l.flexStyle[c[0] + "Start"]), d.marginTop = r(l.flexStyle[c[1] + "Before"]), d.marginRight = r(l.flexStyle[c[0] + "After"]), d.marginBottom = r(l.flexStyle[c[1] + "After"]), d.marginLeft = r(l.flexStyle[c[0] + "Before"])
                            }
                        };
                        var s = t("../flexbox")
                    }, {
                        "../flexbox": 7
                    }],
                    18: [function(t, n) {
                        n.exports = function(t) {
                            for (var n = -1, o; o = t[++n];) s(o)
                        };
                        var s = t("../write")
                    }, {
                        "../write": 17
                    }]
                }, {}, [13])(13)
            },
            990: (o, r, e) => {
                var t, s, i;
                i = function(W) {
                    "use strict";

                    function t(w, H) {
                        function R(p) {
                            if (!(!0 === Te.data(E + "_intouch") || 0 < W(p.target).closest(H.excludedElements, Te).length)) {
                                var c = p.originalEvent || p;
                                if (!c.pointerType || "mouse" != c.pointerType || 0 != H.fallbackToMouseEvents) {
                                    var s = c.touches,
                                        t = s ? s[0] : c,
                                        i;
                                    return Ee = y, s ? Ae = s.length : !1 !== H.preventDefaultEvents && p.preventDefault(), we = ye = he = null, xe = 1, Se = _e = ve = be = V = 0, (p = {})[n] = A(n), p[a] = A(a), p[l] = A(l), p[d] = A(d), Ce = p, de(), T(0, t), !s || Ae === H.fingers || H.fingers === e || te() ? (Ie = P(), 2 == Ae && (T(1, s[1]), ve = _e = me(ke[0].start, ke[1].start)), (H.swipeStatus || H.pinchStatus) && (i = $(c, Ee))) : i = !1, !1 === i ? ($(c, Ee = S), i) : (H.hold && ($e = setTimeout(W.proxy(function() {
                                        Te.trigger("hold", [c.target]), H.hold && (i = H.hold.call(Te, c, c.target))
                                    }, this), H.longTapThreshold)), ue(!0), null)
                                }
                            }
                        }

                        function q(t) {
                            var g = t.originalEvent || t,
                                c, m, y, w;
                            Ee === x || Ee === S || pe() || (c = fe((m = g.touches) ? m[0] : g), Oe = P(), m && (Ae = m.length), H.hold && clearTimeout($e), Ee = _, 2 == Ae && (0 == ve ? (T(1, m[1]), ve = _e = me(ke[0].start, ke[1].start)) : (fe(m[1]), _e = me(ke[0].end, ke[1].end), ke[0].end, ke[1].end, we = 1 > xe ? u : p), xe = (1 * (_e / ve)).toFixed(2), Se = Math.abs(ve - _e)), Ae === H.fingers || H.fingers === e || !m || te() ? (he = I(c.start, c.end), function(p, o) {
                                if (!1 !== H.preventDefaultEvents)
                                    if (H.allowPageScroll === f) p.preventDefault();
                                    else {
                                        var e = H.allowPageScroll === s;
                                        o === n ? (H.swipeLeft && e || !e && H.allowPageScroll != r) && p.preventDefault() : o === a ? (H.swipeRight && e || !e && H.allowPageScroll != r) && p.preventDefault() : o === l ? (H.swipeUp && e || !e && H.allowPageScroll != i) && p.preventDefault() : o === d ? (H.swipeDown && e || !e && H.allowPageScroll != i) && p.preventDefault() : void 0
                                    }
                            }(t, ye = I(c.last, c.end)), y = c.start, w = c.end, V = Math.round(Math.sqrt(Math.pow(w.x - y.x, 2) + Math.pow(w.y - y.y, 2))), be = k(), m = V, (t = he) != f && (m = Math.max(m, ge(t)), Ce[t].distance = m), w = $(g, Ee), H.triggerOnTouchEnd && !H.triggerOnTouchLeave || (y = !0, H.triggerOnTouchLeave && (t = {
                                left: (m = (t = W(t = this)).offset()).left,
                                right: m.left + t.outerWidth(),
                                top: m.top,
                                bottom: m.top + t.outerHeight()
                            }, c = c.end, t = t, y = c.x > t.left && c.x < t.right && c.y > t.top && c.y < t.bottom), !H.triggerOnTouchEnd && y ? Ee = Y(_) : H.triggerOnTouchLeave && !y && (Ee = Y(x)), Ee != S && Ee != x || $(g, Ee))) : $(g, Ee = S), !1 === w && $(g, Ee = S))
                        }

                        function t(t) {
                            var o = t.originalEvent || t,
                                e = o.touches,
                                n;
                            if (e) {
                                if (e.length && !pe()) return n = o, Pe = P(), De = n.touches.length + 1, !0;
                                if (e.length && pe()) return !0
                            }
                            return pe() && (Ae = De), Oe = P(), be = k(), X() || !G() ? $(o, Ee = S) : H.triggerOnTouchEnd || !1 === H.triggerOnTouchEnd && Ee === _ ? (!1 !== H.preventDefaultEvents && !1 !== t.cancelable && t.preventDefault(), $(o, Ee = x)) : !H.triggerOnTouchEnd && ie() ? K(o, Ee = x, h) : Ee === _ && $(o, Ee = S), ue(!1), null
                        }

                        function U() {
                            _e = ve = Ie = Oe = Ae = 0, de(), ue(!(xe = 1))
                        }

                        function z(e) {
                            e = e.originalEvent || e, H.triggerOnTouchLeave && $(e, Ee = Y(x))
                        }

                        function Q() {
                            Te.off(D, R), Te.off(L, U), Te.off(N, q), Te.off(B, t), F && Te.off(F, z), ue(!1)
                        }

                        function Y(t) {
                            var o = t,
                                r = Z(),
                                s = G(),
                                n = X();
                            return !r || n ? o = S : s && t == _ && (!H.triggerOnTouchEnd || H.triggerOnTouchLeave) ? o = x : !s && t == x && H.triggerOnTouchLeave && (o = S), o
                        }

                        function $(n, o) {
                            var e = n.touches,
                                t;
                            return (ne() && oe() || oe()) && (t = K(n, o, g)), (ee() && te() || te()) && !1 !== t && (t = K(n, o, c)), le() && ae() && !1 !== t ? t = K(n, o, b) : be > H.longTapThreshold && V < m && H.longTap && !1 !== t ? t = K(n, o, v) : 1 !== Ae && C || !(isNaN(V) || V < H.threshold) || !ie() || !1 === t || (t = K(n, o, h)), o === S && U(), o === x && (e && e.length || U()), t
                        }

                        function K(r, o, e) {
                            var t;
                            if (e == g) {
                                if (Te.trigger("swipeStatus", [o, he || null, V || 0, be || 0, Ae, ke, ye]), H.swipeStatus && !1 === (t = H.swipeStatus.call(Te, r, o, he || null, V || 0, be || 0, Ae, ke, ye))) return !1;
                                if (o == x && ne()) {
                                    if (clearTimeout(je), clearTimeout($e), Te.trigger("swipe", [he, V, be, Ae, ke, ye]), H.swipe && !1 === (t = H.swipe.call(Te, r, he, V, be, Ae, ke, ye))) return !1;
                                    he === n ? (Te.trigger("swipeLeft", [he, V, be, Ae, ke, ye]), H.swipeLeft && (t = H.swipeLeft.call(Te, r, he, V, be, Ae, ke, ye))) : he === a ? (Te.trigger("swipeRight", [he, V, be, Ae, ke, ye]), H.swipeRight && (t = H.swipeRight.call(Te, r, he, V, be, Ae, ke, ye))) : he === l ? (Te.trigger("swipeUp", [he, V, be, Ae, ke, ye]), H.swipeUp && (t = H.swipeUp.call(Te, r, he, V, be, Ae, ke, ye))) : he === d ? (Te.trigger("swipeDown", [he, V, be, Ae, ke, ye]), H.swipeDown && (t = H.swipeDown.call(Te, r, he, V, be, Ae, ke, ye))) : void 0
                                }
                            }
                            if (e == c) {
                                if (Te.trigger("pinchStatus", [o, we || null, Se || 0, be || 0, Ae, xe, ke]), H.pinchStatus && !1 === (t = H.pinchStatus.call(Te, r, o, we || null, Se || 0, be || 0, Ae, xe, ke))) return !1;
                                o == x && ee() && (we === p ? (Te.trigger("pinchIn", [we || null, Se || 0, be || 0, Ae, xe, ke]), H.pinchIn && (t = H.pinchIn.call(Te, r, we || null, Se || 0, be || 0, Ae, xe, ke))) : we === u ? (Te.trigger("pinchOut", [we || null, Se || 0, be || 0, Ae, xe, ke]), H.pinchOut && (t = H.pinchOut.call(Te, r, we || null, Se || 0, be || 0, Ae, xe, ke))) : void 0)
                            }
                            return e == h ? o !== S && o !== x || (clearTimeout(je), clearTimeout($e), ae() && !le() ? (Ne = P(), je = setTimeout(W.proxy(function() {
                                Ne = null, Te.trigger("tap", [r.target]), H.tap && (t = H.tap.call(Te, r, r.target))
                            }, this), H.doubleTapThreshold)) : (Ne = null, Te.trigger("tap", [r.target]), H.tap && (t = H.tap.call(Te, r, r.target)))) : e == b ? o !== S && o !== x || (clearTimeout(je), clearTimeout($e), Ne = null, Te.trigger("doubletap", [r.target]), H.doubleTap && (t = H.doubleTap.call(Te, r, r.target))) : e == v && (o !== S && o !== x || (clearTimeout(je), Ne = null, Te.trigger("longtap", [r.target]), H.longTap && (t = H.longTap.call(Te, r, r.target)))), t
                        }

                        function G() {
                            var e = !0;
                            return e = null === H.threshold ? e : V >= H.threshold
                        }

                        function X() {
                            var e = !1;
                            return e = null !== H.cancelThreshold && null !== he ? ge(he) - V >= H.cancelThreshold : e
                        }

                        function Z() {
                            return !H.maxTimeThreshold || !(be >= H.maxTimeThreshold)
                        }

                        function ee() {
                            var n = re(),
                                o = se(),
                                e = null === H.pinchThreshold || Se >= H.pinchThreshold;
                            return n && o && e
                        }

                        function te() {
                            return H.pinchStatus || H.pinchIn || H.pinchOut
                        }

                        function ne() {
                            var r = Z(),
                                o = G(),
                                e = re(),
                                t = se();
                            return !X() && t && e && o && r
                        }

                        function oe() {
                            return H.swipe || H.swipeStatus || H.swipeLeft || H.swipeRight || H.swipeUp || H.swipeDown
                        }

                        function re() {
                            return Ae === H.fingers || H.fingers === e || !C
                        }

                        function se() {
                            return 0 !== ke[0].end.x
                        }

                        function ie() {
                            return H.tap
                        }

                        function ae() {
                            return !!H.doubleTap
                        }

                        function le() {
                            if (null == Ne) return !1;
                            var e = P();
                            return ae() && e - Ne <= H.doubleTapThreshold
                        }

                        function de() {
                            De = Pe = 0
                        }

                        function pe() {
                            var e = !1;
                            return e = !!(Pe && P() - Pe <= H.fingerReleaseThreshold) || e
                        }

                        function ue(e) {
                            Te && (!0 === e ? (Te.on(N, q), Te.on(B, t), F && Te.on(F, z)) : (Te.off(N, q, !1), Te.off(B, t, !1), F && Te.off(F, z, !1)), Te.data(E + "_intouch", !0 === e))
                        }

                        function T(n, o) {
                            var e = {
                                start: {
                                    x: 0,
                                    y: 0
                                },
                                last: {
                                    x: 0,
                                    y: 0
                                },
                                end: {
                                    x: 0,
                                    y: 0
                                }
                            };
                            return e.start.x = e.last.x = e.end.x = o.pageX || o.clientX, e.start.y = e.last.y = e.end.y = o.pageY || o.clientY, ke[n] = e
                        }

                        function fe(n) {
                            var o = void 0 === n.identifier ? 0 : n.identifier,
                                e = ke[o] || null;
                            return (e = null === e ? T(o, n) : e).last.x = e.end.x, e.last.y = e.end.y, e.end.x = n.pageX || n.clientX, e.end.y = n.pageY || n.clientY, e
                        }

                        function ge(e) {
                            return Ce[e] ? Ce[e].distance : void 0
                        }

                        function A(e) {
                            return {
                                direction: e,
                                distance: 0
                            }
                        }

                        function k() {
                            return Oe - Ie
                        }

                        function me(t, n) {
                            var o = Math.abs(t.x - n.x),
                                n = Math.abs(t.y - n.y);
                            return Math.round(Math.sqrt(o * o + n * n))
                        }

                        function I(e, t) {
                            if (p = t, (i = e).x == p.x && i.y == p.y) return f;
                            var e = (p = t, e = (t = e).x - p.x, t = p.y - t.y, e = Math.atan2(t, e), e = 0 > (e = Math.round(180 * e / Math.PI)) ? 360 - Math.abs(e) : e),
                                i, p;
                            return 45 >= e && 0 <= e || 360 >= e && 315 <= e ? n : 135 <= e && 225 >= e ? a : 45 < e && 135 > e ? d : l
                        }

                        function P() {
                            return new Date().getTime()
                        }
                        var H = W.extend({}, H),
                            o = C || j || !H.fallbackToMouseEvents,
                            D = o ? j ? O ? "MSPointerDown" : "pointerdown" : "touchstart" : "mousedown",
                            N = o ? j ? O ? "MSPointerMove" : "pointermove" : "touchmove" : "mousemove",
                            B = o ? j ? O ? "MSPointerUp" : "pointerup" : "touchend" : "mouseup",
                            F = !o || j ? "mouseleave" : null,
                            L = j ? O ? "MSPointerCancel" : "pointercancel" : "touchcancel",
                            V = 0,
                            he = null,
                            ye = null,
                            be = 0,
                            ve = 0,
                            _e = 0,
                            xe = 1,
                            Se = 0,
                            we = 0,
                            Ce = null,
                            Te = W(w),
                            Ee = "start",
                            Ae = 0,
                            ke = {},
                            Ie = 0,
                            Oe = 0,
                            Pe = 0,
                            De = 0,
                            Ne = 0,
                            je = null,
                            $e = null;
                        try {
                            Te.on(D, R), Te.on(L, U)
                        } catch (e) {
                            W.error("events not supported " + D + "," + L + " on jQuery.swipe")
                        }
                        this.enable = function() {
                            return this.disable(), Te.on(D, R), Te.on(L, U), Te
                        }, this.disable = function() {
                            return Q(), Te
                        }, this.destroy = function() {
                            Q(), Te.data(E, null), Te = null
                        }, this.option = function(t, n) {
                            if ("object" == typeof t) H = W.extend(H, t);
                            else if (void 0 !== H[t]) {
                                if (void 0 === n) return H[t];
                                H[t] = n
                            } else {
                                if (!t) return H;
                                W.error("Option " + t + " does not exist on jQuery.swipe.options")
                            }
                            return null
                        }
                    }
                    var n = "left",
                        a = "right",
                        l = "up",
                        d = "down",
                        p = "in",
                        u = "out",
                        f = "none",
                        s = "auto",
                        g = "swipe",
                        c = "pinch",
                        h = "tap",
                        b = "doubletap",
                        v = "longtap",
                        r = "horizontal",
                        i = "vertical",
                        e = "all",
                        m = 10,
                        y = "start",
                        _ = "move",
                        x = "end",
                        S = "cancel",
                        C = ("ontouchstart" in window),
                        O = window.navigator.msPointerEnabled && !window.PointerEvent && !C,
                        j = (window.PointerEvent || window.navigator.msPointerEnabled) && !C,
                        E = "TouchSwipe";
                    W.fn.swipe = function(n) {
                        var o = W(this),
                            e = o.data("TouchSwipe");
                        if (e && "string" == typeof n) {
                            if (e[n]) return e[n].apply(e, Array.prototype.slice.call(arguments, 1));
                            W.error("Method " + n + " does not exist on jQuery.swipe")
                        } else if (e && "object" == typeof n) e.option.apply(e, arguments);
                        else if (!(e || "object" != typeof n && n)) return function(o) {
                            return !o || void 0 !== o.allowPageScroll || void 0 === o.swipe && void 0 === o.swipeStatus || (o.allowPageScroll = "none"), void 0 !== o.click && void 0 === o.tap && (o.tap = o.click), o = W.extend({}, W.fn.swipe.defaults, o = o || {}), this.each(function() {
                                var r = W(this),
                                    n = r.data("TouchSwipe");
                                n || (n = new t(this, o), r.data("TouchSwipe", n))
                            })
                        }.apply(this, arguments);
                        return o
                    }, W.fn.swipe.version = "1.6.18", W.fn.swipe.defaults = {
                        fingers: 1,
                        threshold: 75,
                        cancelThreshold: null,
                        pinchThreshold: 20,
                        maxTimeThreshold: null,
                        fingerReleaseThreshold: 250,
                        longTapThreshold: 500,
                        doubleTapThreshold: 200,
                        swipe: null,
                        swipeLeft: null,
                        swipeRight: null,
                        swipeUp: null,
                        swipeDown: null,
                        swipeStatus: null,
                        pinchIn: null,
                        pinchOut: null,
                        pinchStatus: null,
                        click: null,
                        tap: null,
                        doubleTap: null,
                        longTap: null,
                        hold: null,
                        triggerOnTouchEnd: !0,
                        triggerOnTouchLeave: !1,
                        allowPageScroll: "auto",
                        fallbackToMouseEvents: !0,
                        excludedElements: ".noSwipe",
                        preventDefaultEvents: !0
                    }, W.fn.swipe.phases = {
                        PHASE_START: "start",
                        PHASE_MOVE: "move",
                        PHASE_END: "end",
                        PHASE_CANCEL: "cancel"
                    }, W.fn.swipe.directions = {
                        LEFT: "left",
                        RIGHT: "right",
                        UP: "up",
                        DOWN: "down",
                        IN: "in",
                        OUT: "out"
                    }, W.fn.swipe.pageScroll = {
                        NONE: "none",
                        HORIZONTAL: "horizontal",
                        VERTICAL: "vertical",
                        AUTO: "auto"
                    }, W.fn.swipe.fingers = {
                        ONE: 1,
                        TWO: 2,
                        THREE: 3,
                        FOUR: 4,
                        FIVE: 5,
                        ALL: "all"
                    }
                }, e.amdO.jQuery ? (t = [e(609)], void 0 === (s = "function" == typeof(s = i) ? s.apply(r, t) : s) || (o.exports = s)) : i(o.exports ? e(609) : jQuery)
            },
            519: function(e, t) {
                var n;
                void 0 === (n = "function" == typeof(n = function() {
                    "use strict";

                    function i(t, n) {
                        if (!(t instanceof n)) throw new TypeError("Cannot call a class as a function")
                    }

                    function d(o) {
                        var s = o.getBoundingClientRect(),
                            e = {};
                        for (var t in s) e[t] = s[t];
                        try {
                            if (o.ownerDocument !== document) {
                                var n = o.ownerDocument.defaultView.frameElement;
                                if (n) {
                                    var i = d(n);
                                    e.top += i.top, e.bottom += i.top, e.left += i.left, e.right += i.left
                                }
                            }
                        } catch (e) {}
                        return e
                    }

                    function c(o) {
                        var r = getComputedStyle(o) || {},
                            e = r.position,
                            t = [];
                        if ("fixed" === e) return [o];
                        for (var n = o, d;
                            (n = n.parentNode) && n && 1 === n.nodeType;) {
                            d = void 0;
                            try {
                                d = getComputedStyle(n)
                            } catch (e) {}
                            if ("undefined" == typeof d || null === d) return t.push(n), t;
                            var c = d,
                                u = c.overflow,
                                s = c.overflowX,
                                a = c.overflowY;
                            /(auto|scroll|overlay)/.test(u + a + s) && ("absolute" !== e || 0 <= ["relative", "absolute", "fixed"].indexOf(d.position)) && t.push(n)
                        }
                        return t.push(o.ownerDocument.body), o.ownerDocument !== document && t.push(o.ownerDocument.defaultView), t
                    }

                    function r() {
                        I && document.body.removeChild(I), I = null
                    }

                    function h(e) {
                        var t;
                        e === document ? (t = document, e = document.documentElement) : t = e.ownerDocument;
                        var r = t.documentElement,
                            a = d(e),
                            n = Y();
                        return a.top -= n.top, a.left -= n.left, "undefined" == typeof a.width && (a.width = document.body.scrollWidth - a.left - a.right), "undefined" == typeof a.height && (a.height = document.body.scrollHeight - a.top - a.bottom), a.top -= r.clientTop, a.left -= r.clientLeft, a.right = t.body.clientWidth - a.width - a.left, a.bottom = t.body.clientHeight - a.height - a.top, a
                    }

                    function u(e) {
                        return e.offsetParent || document.documentElement
                    }

                    function f() {
                        if (a) return a;
                        var r = document.createElement("div");
                        r.style.width = "100%", r.style.height = "200px";
                        var o = document.createElement("div");
                        A(o.style, {
                            position: "absolute",
                            top: 0,
                            left: 0,
                            pointerEvents: "none",
                            visibility: "hidden",
                            width: "200px",
                            height: "150px",
                            overflow: "hidden"
                        }), o.appendChild(r), document.body.appendChild(o);
                        var e = r.offsetWidth;
                        o.style.overflow = "scroll";
                        var t = r.offsetWidth;
                        e === t && (t = o.clientWidth), document.body.removeChild(o);
                        var i = e - t;
                        return a = {
                            width: i,
                            height: i
                        }, a
                    }

                    function A() {
                        var r = 0 >= arguments.length || void 0 === arguments[0] ? {} : arguments[0],
                            e = [];
                        return Array.prototype.push.apply(e, arguments), e.slice(1).forEach(function(t) {
                            if (t)
                                for (var n in t)({}).hasOwnProperty.call(t, n) && (r[n] = t[n])
                        }), r
                    }

                    function b(r, o) {
                        if ("undefined" != typeof r.classList) o.split(" ").forEach(function(e) {
                            e.trim() && r.classList.remove(e)
                        });
                        else {
                            var t = new RegExp("(^| )" + o.split(" ").join("|") + "( |$)", "gi"),
                                e = C(r).replace(t, " ");
                            p(r, e)
                        }
                    }

                    function _(n, o) {
                        if ("undefined" != typeof n.classList) o.split(" ").forEach(function(e) {
                            e.trim() && n.classList.add(e)
                        });
                        else {
                            b(n, o);
                            var t = C(n) + (" " + o);
                            p(n, t)
                        }
                    }

                    function S(n, o) {
                        if ("undefined" != typeof n.classList) return n.classList.contains(o);
                        var e = C(n);
                        return new RegExp("(^| )" + o + "( |$)", "gi").test(e)
                    }

                    function C(e) {
                        return e.className instanceof e.ownerDocument.defaultView.SVGAnimatedString ? e.className.baseVal : e.className
                    }

                    function p(t, n) {
                        t.setAttribute("class", n)
                    }

                    function m(e, o, t) {
                        t.forEach(function(t) {
                            -1 === o.indexOf(t) && S(e, t) && b(e, t)
                        }), o.forEach(function(n) {
                            S(e, n) || _(e, n)
                        })
                    }

                    function i(t, n) {
                        if (!(t instanceof n)) throw new TypeError("Cannot call a class as a function")
                    }

                    function T(t, n) {
                        if ("function" != typeof n && null !== n) throw new TypeError("Super expression must either be null or a function, not " + typeof n);
                        t.prototype = Object.create(n && n.prototype, {
                            constructor: {
                                value: t,
                                enumerable: !1,
                                writable: !0,
                                configurable: !0
                            }
                        }), n && (Object.setPrototypeOf ? Object.setPrototypeOf(t, n) : t.__proto__ = n)
                    }

                    function E(n, o) {
                        var e = 2 >= arguments.length || void 0 === arguments[2] ? 1 : arguments[2];
                        return n + e >= o && o >= n - e
                    }

                    function v() {
                        return "object" == typeof performance && "function" == typeof performance.now ? performance.now() : +new Date
                    }

                    function O() {
                        for (var n = {
                                top: 0,
                                left: 0
                            }, o = arguments.length, r = Array(o), e = 0; e < o; e++) r[e] = arguments[e];
                        return r.forEach(function(t) {
                            var o = t.top,
                                r = t.left;
                            "string" == typeof o && (o = parseFloat(o, 10)), "string" == typeof r && (r = parseFloat(r, 10)), n.top += o, n.left += r
                        }), n
                    }

                    function N(t, n) {
                        return "string" == typeof t.left && -1 !== t.left.indexOf("%") && (t.left = parseFloat(t.left, 10) / 100 * n.width), "string" == typeof t.top && -1 !== t.top.indexOf("%") && (t.top = parseFloat(t.top, 10) / 100 * n.height), t
                    }

                    function k(e, a) {
                        return "scrollParent" === a ? a = e.scrollParents[0] : "window" === a && (a = [pageXOffset, pageYOffset, innerWidth + pageXOffset, innerHeight + pageYOffset]), a === document && (a = a.documentElement), "undefined" != typeof a.nodeType && function() {
                            var r = a,
                                o = h(a),
                                e = o,
                                t = getComputedStyle(a);
                            if (a = [e.left, e.top, o.width + e.left, o.height + e.top], r.ownerDocument !== document) {
                                var n = r.ownerDocument.defaultView;
                                a[0] += n.pageXOffset, a[1] += n.pageYOffset, a[2] += n.pageXOffset, a[3] += n.pageYOffset
                            }
                            $.forEach(function(e, n) {
                                e = e[0].toUpperCase() + e.substr(1), "Top" === e || "Left" === e ? a[n] += parseFloat(t["border" + e + "Width"]) : a[n] -= parseFloat(t["border" + e + "Width"])
                            })
                        }(), a
                    }
                    var w = function() {
                            function n(n, o) {
                                for (var e = 0, s; e < o.length; e++) s = o[e], s.enumerable = s.enumerable || !1, s.configurable = !0, "value" in s && (s.writable = !0), Object.defineProperty(n, s.key, s)
                            }
                            return function(o, r, e) {
                                return r && n(o.prototype, r), e && n(o, e), o
                            }
                        }(),
                        W;
                    "undefined" == typeof W && (W = {
                        modules: []
                    });
                    var I = null,
                        M = function() {
                            var e = 0;
                            return function() {
                                return ++e
                            }
                        }(),
                        z = {},
                        Y = function() {
                            var t = I;
                            t && document.body.contains(t) || (t = document.createElement("div"), t.setAttribute("data-tether-id", M()), A(t.style, {
                                top: 0,
                                left: 0,
                                position: "absolute"
                            }), document.body.appendChild(t), I = t);
                            var n = t.getAttribute("data-tether-id");
                            return "undefined" == typeof z[n] && (z[n] = d(t), oe(function() {
                                delete z[n]
                            })), z[n]
                        },
                        a = null,
                        ne = [],
                        oe = function(t) {
                            ne.push(t)
                        },
                        se = function() {
                            for (var t; t = ne.pop();) t()
                        },
                        ae = function() {
                            function e() {
                                i(this, e)
                            }
                            return w(e, [{
                                key: "on",
                                value: function(r, e, t) {
                                    var n = !(3 >= arguments.length || void 0 === arguments[3]) && arguments[3];
                                    "undefined" == typeof this.bindings && (this.bindings = {}), "undefined" == typeof this.bindings[r] && (this.bindings[r] = []), this.bindings[r].push({
                                        handler: e,
                                        ctx: t,
                                        once: n
                                    })
                                }
                            }, {
                                key: "once",
                                value: function(o, e, t) {
                                    this.on(o, e, t, !0)
                                }
                            }, {
                                key: "off",
                                value: function(o, e) {
                                    if ("undefined" != typeof this.bindings && "undefined" != typeof this.bindings[o])
                                        if ("undefined" == typeof e) delete this.bindings[o];
                                        else
                                            for (var t = 0; t < this.bindings[o].length;) this.bindings[o][t].handler === e ? this.bindings[o].splice(t, 1) : ++t
                                }
                            }, {
                                key: "trigger",
                                value: function(n) {
                                    if ("undefined" != typeof this.bindings && this.bindings[n]) {
                                        for (var e = 0, o = arguments.length, d = Array(1 < o ? o - 1 : 0), i = 1; i < o; i++) d[i - 1] = arguments[i];
                                        for (; e < this.bindings[n].length;) {
                                            var u = this.bindings[n][e],
                                                p = u.handler,
                                                s = u.ctx,
                                                a = u.once,
                                                l = s;
                                            "undefined" == typeof l && (l = this), p.apply(l, d), a ? this.bindings[n].splice(e, 1) : ++e
                                        }
                                    }
                                }
                            }]), e
                        }();
                    W.Utils = {
                        getActualBoundingClientRect: d,
                        getScrollParents: c,
                        getBounds: h,
                        getOffsetParent: u,
                        extend: A,
                        addClass: _,
                        removeClass: b,
                        hasClass: S,
                        updateClasses: m,
                        defer: oe,
                        flush: se,
                        uniqueId: M,
                        Evented: ae,
                        getScrollBarSize: f,
                        removeUtilElements: r
                    };
                    var le = function() {
                            function t(o, r) {
                                var e = [],
                                    t = !0,
                                    i = !1,
                                    a;
                                try {
                                    for (var l = o[Symbol.iterator](), c; !(t = (c = l.next()).done) && (e.push(c.value), !(r && e.length === r)); t = !0);
                                } catch (e) {
                                    i = !0, a = e
                                } finally {
                                    try {
                                        !t && l["return"] && l["return"]()
                                    } finally {
                                        if (i) throw a
                                    }
                                }
                                return e
                            }
                            return function(o, n) {
                                if (Array.isArray(o)) return o;
                                if (Symbol.iterator in Object(o)) return t(o, n);
                                throw new TypeError("Invalid attempt to destructure non-iterable instance")
                            }
                        }(),
                        w = function() {
                            function n(n, o) {
                                for (var e = 0, s; e < o.length; e++) s = o[e], s.enumerable = s.enumerable || !1, s.configurable = !0, "value" in s && (s.writable = !0), Object.defineProperty(n, s.key, s)
                            }
                            return function(o, r, e) {
                                return r && n(o.prototype, r), e && n(o, e), o
                            }
                        }(),
                        t = function(t, n, o) {
                            var r = !0;
                            e: for (; r;) {
                                var i = t,
                                    l = n,
                                    c = o;
                                r = !1, null === i && (i = Function.prototype);
                                var s = Object.getOwnPropertyDescriptor(i, l);
                                if (void 0 === s) {
                                    var u = Object.getPrototypeOf(i);
                                    if (null === u) return;
                                    t = u, n = l, o = c, r = !0, s = u = void 0;
                                    continue e
                                } else {
                                    if ("value" in s) return s.value;
                                    var g = s.get;
                                    return void 0 === g ? void 0 : g.call(c)
                                }
                            }
                        };
                    if ("undefined" == typeof W) throw new Error("You must include the utils.js file before tether.js");
                    var ce = W.Utils,
                        c = ce.getScrollParents,
                        h = ce.getBounds,
                        u = ce.getOffsetParent,
                        A = ce.extend,
                        _ = ce.addClass,
                        b = ce.removeClass,
                        m = ce.updateClasses,
                        oe = ce.defer,
                        se = ce.flush,
                        f = ce.getScrollBarSize,
                        r = ce.removeUtilElements,
                        ue = function() {
                            if ("undefined" == typeof document) return "";
                            for (var n = document.createElement("div"), o = ["transform", "WebkitTransform", "OTransform", "MozTransform", "msTransform"], e = 0, s; e < o.length; ++e)
                                if (s = o[e], void 0 !== n.style[s]) return s
                        }(),
                        y = [],
                        x = function() {
                            y.forEach(function(e) {
                                e.position(!1)
                            }), se()
                        };
                    (function() {
                        var e = null,
                            n = null,
                            r = null,
                            i = function o() {
                                return "undefined" != typeof n && 16 < n ? (n = Math.min(n - 16, 250), void(r = setTimeout(o, 250))) : void("undefined" != typeof e && 10 > v() - e || (null != r && (clearTimeout(r), r = null), e = v(), x(), n = v() - e))
                            };
                        "undefined" != typeof window && "undefined" != typeof window.addEventListener && ["resize", "scroll", "touchmove"].forEach(function(e) {
                            window.addEventListener(e, i)
                        })
                    })();
                    var P = {
                            center: "center",
                            left: "right",
                            right: "left"
                        },
                        D = {
                            middle: "middle",
                            top: "bottom",
                            bottom: "top"
                        },
                        j = {
                            top: 0,
                            left: 0,
                            middle: "50%",
                            center: "50%",
                            bottom: "100%",
                            right: "100%"
                        },
                        B = function(r, e) {
                            var t = r.left,
                                s = r.top;
                            return "auto" === t && (t = P[e.left]), "auto" === s && (s = D[e.top]), {
                                left: t,
                                top: s
                            }
                        },
                        F = function(n) {
                            var e = n.left,
                                r = n.top;
                            return "undefined" != typeof j[n.left] && (e = j[n.left]), "undefined" != typeof j[n.top] && (r = j[n.top]), {
                                left: e,
                                top: r
                            }
                        },
                        L = function(e) {
                            var o = e.split(" "),
                                t = le(o, 2),
                                n = t[0],
                                s = t[1];
                            return {
                                top: n,
                                left: s
                            }
                        },
                        V = L,
                        H = function(e) {
                            function s(e) {
                                var n = this;
                                i(this, s), t(Object.getPrototypeOf(s.prototype), "constructor", this).call(this), this.position = this.position.bind(this), y.push(this), this.history = [], this.setOptions(e, !1), W.modules.forEach(function(e) {
                                    "undefined" != typeof e.initialize && e.initialize.call(n)
                                }), this.position()
                            }
                            return T(s, e), w(s, [{
                                key: "getClass",
                                value: function() {
                                    var n = 0 >= arguments.length || void 0 === arguments[0] ? "" : arguments[0],
                                        e = this.options.classes;
                                    return "undefined" != typeof e && e[n] ? this.options.classes[n] : this.options.classPrefix ? this.options.classPrefix + "-" + n : n
                                }
                            }, {
                                key: "setOptions",
                                value: function(a) {
                                    var e = this,
                                        t = !!(1 >= arguments.length || void 0 === arguments[1]) || arguments[1];
                                    this.options = A({
                                        offset: "0 0",
                                        targetOffset: "0 0",
                                        targetAttachment: "auto auto",
                                        classPrefix: "tether"
                                    }, a);
                                    var n = this.options,
                                        r = n.element,
                                        o = n.target,
                                        i = n.targetModifier;
                                    if (this.element = r, this.target = o, this.targetModifier = i, "viewport" === this.target ? (this.target = document.body, this.targetModifier = "visible") : "scroll-handle" === this.target && (this.target = document.body, this.targetModifier = "scroll-handle"), ["element", "target"].forEach(function(t) {
                                            if ("undefined" == typeof e[t]) throw new Error("Tether Error: Both element and target must be defined");
                                            "undefined" == typeof e[t].jquery ? "string" == typeof e[t] && (e[t] = document.querySelector(e[t])) : e[t] = e[t][0]
                                        }), _(this.element, this.getClass("element")), !1 === this.options.addTargetClasses || _(this.target, this.getClass("target")), !this.options.attachment) throw new Error("Tether Error: You must provide an attachment");
                                    this.targetAttachment = V(this.options.targetAttachment), this.attachment = V(this.options.attachment), this.offset = L(this.options.offset), this.targetOffset = L(this.options.targetOffset), "undefined" != typeof this.scrollParents && this.disable(), this.scrollParents = "scroll-handle" === this.targetModifier ? [this.target] : c(this.target), !1 === this.options.enabled || this.enable(t)
                                }
                            }, {
                                key: "getTargetBounds",
                                value: function() {
                                    if ("undefined" != typeof this.targetModifier) {
                                        if ("visible" === this.targetModifier) {
                                            if (this.target === document.body) return {
                                                top: pageYOffset,
                                                left: pageXOffset,
                                                height: innerHeight,
                                                width: innerWidth
                                            };
                                            var t = h(this.target),
                                                n = {
                                                    height: t.height,
                                                    width: t.width,
                                                    top: t.top,
                                                    left: t.left
                                                };
                                            return n.height = Math.min(n.height, t.height - (pageYOffset - t.top)), n.height = Math.min(n.height, t.height - (t.top + t.height - (pageYOffset + innerHeight))), n.height = Math.min(innerHeight, n.height), n.height -= 2, n.width = Math.min(n.width, t.width - (pageXOffset - t.left)), n.width = Math.min(n.width, t.width - (t.left + t.width - (pageXOffset + innerWidth))), n.width = Math.min(innerWidth, n.width), n.width -= 2, n.top < pageYOffset && (n.top = pageYOffset), n.left < pageXOffset && (n.left = pageXOffset), n
                                        }
                                        if ("scroll-handle" === this.targetModifier) {
                                            var s = this.target,
                                                t;
                                            s === document.body ? (s = document.documentElement, t = {
                                                left: pageXOffset,
                                                top: pageYOffset,
                                                height: innerHeight,
                                                width: innerWidth
                                            }) : t = h(s);
                                            var i = getComputedStyle(s),
                                                l = s.scrollWidth > s.clientWidth || 0 <= [i.overflow, i.overflowX].indexOf("scroll") || this.target !== document.body,
                                                r = 0;
                                            l && (r = 15);
                                            var c = t.height - parseFloat(i.borderTopWidth) - parseFloat(i.borderBottomWidth) - r,
                                                n = {
                                                    width: 15,
                                                    height: .975 * c * (c / s.scrollHeight),
                                                    left: t.left + t.width - parseFloat(i.borderLeftWidth) - 15
                                                },
                                                u = 0;
                                            408 > c && this.target === document.body && (u = -11e-5 * Math.pow(c, 2) - .00727 * c + 22.58), this.target !== document.body && (n.height = Math.max(n.height, 24));
                                            var f = this.target.scrollTop / (s.scrollHeight - c);
                                            return n.top = f * (c - n.height - u) + t.top + parseFloat(i.borderTopWidth), this.target === document.body && (n.height = Math.max(n.height, 24)), n
                                        }
                                    } else return h(this.target)
                                }
                            }, {
                                key: "clearCache",
                                value: function() {
                                    this._cache = {}
                                }
                            }, {
                                key: "cache",
                                value: function(n, e) {
                                    return "undefined" == typeof this._cache && (this._cache = {}), "undefined" == typeof this._cache[n] && (this._cache[n] = e.call(this)), this._cache[n]
                                }
                            }, {
                                key: "enable",
                                value: function() {
                                    var n = this,
                                        t = !!(0 >= arguments.length || void 0 === arguments[0]) || arguments[0];
                                    !1 === this.options.addTargetClasses || _(this.target, this.getClass("enabled")), _(this.element, this.getClass("enabled")), this.enabled = !0, this.scrollParents.forEach(function(e) {
                                        e !== n.target.ownerDocument && e.addEventListener("scroll", n.position)
                                    }), t && this.position()
                                }
                            }, {
                                key: "disable",
                                value: function() {
                                    var e = this;
                                    b(this.target, this.getClass("enabled")), b(this.element, this.getClass("enabled")), this.enabled = !1, "undefined" != typeof this.scrollParents && this.scrollParents.forEach(function(n) {
                                        n.removeEventListener("scroll", e.position)
                                    })
                                }
                            }, {
                                key: "destroy",
                                value: function() {
                                    var t = this;
                                    this.disable(), y.forEach(function(o, n) {
                                        o === t && y.splice(n, 1)
                                    }), 0 === y.length && r()
                                }
                            }, {
                                key: "updateAttachClasses",
                                value: function(t, n) {
                                    var s = this;
                                    t = t || this.attachment, n = n || this.targetAttachment, "undefined" != typeof this._addAttachClasses && this._addAttachClasses.length && this._addAttachClasses.splice(0, this._addAttachClasses.length), "undefined" == typeof this._addAttachClasses && (this._addAttachClasses = []);
                                    var a = this._addAttachClasses;
                                    t.top && a.push(this.getClass("element-attached") + "-" + t.top), t.left && a.push(this.getClass("element-attached") + "-" + t.left), n.top && a.push(this.getClass("target-attached") + "-" + n.top), n.left && a.push(this.getClass("target-attached") + "-" + n.left);
                                    var i = [];
                                    ["left", "top", "bottom", "right", "middle", "center"].forEach(function(e) {
                                        i.push(s.getClass("element-attached") + "-" + e), i.push(s.getClass("target-attached") + "-" + e)
                                    }), oe(function() {
                                        "undefined" == typeof s._addAttachClasses || (m(s.element, s._addAttachClasses, i), !1 !== s.options.addTargetClasses && m(s.target, s._addAttachClasses, i), delete s._addAttachClasses)
                                    })
                                }
                            }, {
                                key: "position",
                                value: function() {
                                    var p = this,
                                        o = !!(0 >= arguments.length || void 0 === arguments[0]) || arguments[0];
                                    if (this.enabled) {
                                        this.clearCache();
                                        var e = B(this.targetAttachment, this.attachment);
                                        this.updateAttachClasses(this.attachment, e);
                                        var t = this.cache("element-bounds", function() {
                                                return h(p.element)
                                            }),
                                            n = t.width,
                                            r = t.height;
                                        if (0 === n && 0 === r && "undefined" != typeof this.lastSize) {
                                            var g = this.lastSize;
                                            n = g.width, r = g.height
                                        } else this.lastSize = {
                                            width: n,
                                            height: r
                                        };
                                        var m = this.cache("target-bounds", function() {
                                                return p.getTargetBounds()
                                            }),
                                            s = m,
                                            l = N(F(this.attachment), {
                                                width: n,
                                                height: r
                                            }),
                                            _ = N(F(e), s),
                                            S = N(this.offset, {
                                                width: n,
                                                height: r
                                            }),
                                            C = N(this.targetOffset, s);
                                        l = O(l, S), _ = O(_, C);
                                        for (var d = m.left + _.left - l.left, E = m.top + _.top - l.top, P = 0; P < W.modules.length; ++P) {
                                            var D = W.modules[P],
                                                I = D.position.call(this, {
                                                    left: d,
                                                    top: E,
                                                    targetAttachment: e,
                                                    targetPos: m,
                                                    elementPos: t,
                                                    offset: l,
                                                    targetOffset: _,
                                                    manualOffset: S,
                                                    manualTargetOffset: C,
                                                    scrollbarSize: w,
                                                    attachment: this.attachment
                                                });
                                            if (!1 === I) return !1;
                                            if ("undefined" == typeof I || "object" != typeof I) continue;
                                            else E = I.top, d = I.left
                                        }
                                        var y = {
                                                page: {
                                                    top: E,
                                                    left: d
                                                },
                                                viewport: {
                                                    top: E - pageYOffset,
                                                    bottom: pageYOffset - E - r + innerHeight,
                                                    left: d - pageXOffset,
                                                    right: pageXOffset - d - n + innerWidth
                                                }
                                            },
                                            v = this.target.ownerDocument,
                                            b = v.defaultView,
                                            w;
                                        return b.innerHeight > v.documentElement.clientHeight && (w = this.cache("scrollbar-size", f), y.viewport.bottom -= w.height), b.innerWidth > v.documentElement.clientWidth && (w = this.cache("scrollbar-size", f), y.viewport.right -= w.width), (-1 === ["", "static"].indexOf(v.body.style.position) || -1 === ["", "static"].indexOf(v.body.parentElement.style.position)) && (y.page.bottom = v.body.scrollHeight - E - r, y.page.right = v.body.scrollWidth - d - n), "undefined" == typeof this.options.optimizations || !1 === this.options.optimizations.moveElement || "undefined" != typeof this.targetModifier || function() {
                                            var s = p.cache("target-offsetparent", function() {
                                                    return u(p.target)
                                                }),
                                                a = p.cache("target-offsetparent-bounds", function() {
                                                    return h(s)
                                                }),
                                                e = getComputedStyle(s),
                                                t = a,
                                                l = {};
                                            if (["Top", "Left", "Bottom", "Right"].forEach(function(t) {
                                                    l[t.toLowerCase()] = parseFloat(e["border" + t + "Width"])
                                                }), a.right = v.body.scrollWidth - a.left - t.width + l.right, a.bottom = v.body.scrollHeight - a.top - t.height + l.bottom, y.page.top >= a.top + l.top && y.page.bottom >= a.bottom && y.page.left >= a.left + l.left && y.page.right >= a.right) {
                                                var n = s.scrollTop,
                                                    r = s.scrollLeft;
                                                y.offset = {
                                                    top: y.page.top - a.top + n - l.top,
                                                    left: y.page.left - a.left + r - l.left
                                                }
                                            }
                                        }(), this.move(y), this.history.unshift(y), 3 < this.history.length && this.history.pop(), o && se(), !0
                                    }
                                }
                            }, {
                                key: "move",
                                value: function(o) {
                                    var s = this;
                                    if ("undefined" != typeof this.element.parentNode) {
                                        var r = {};
                                        for (var t in o)
                                            for (var e in r[t] = {}, o[t]) {
                                                for (var l = !1, p = 0, f; p < this.history.length; ++p)
                                                    if (f = this.history[p], "undefined" != typeof f[t] && !E(f[t][e], o[t][e])) {
                                                        l = !0;
                                                        break
                                                    }
                                                l || (r[t][e] = !0)
                                            }
                                        var g = {
                                                top: "",
                                                left: "",
                                                right: "",
                                                bottom: ""
                                            },
                                            h = function(o, e) {
                                                var t = "undefined" != typeof s.options.optimizations,
                                                    n = t ? s.options.optimizations.gpu : null;
                                                if (!1 !== n) {
                                                    var i, l;
                                                    o.top ? (g.top = 0, i = e.top) : (g.bottom = 0, i = -e.bottom), o.left ? (g.left = 0, l = e.left) : (g.right = 0, l = -e.right), "number" == typeof window.devicePixelRatio && 0 == devicePixelRatio % 1 && (l = Math.round(l * devicePixelRatio) / devicePixelRatio, i = Math.round(i * devicePixelRatio) / devicePixelRatio), g[ue] = "translateX(" + l + "px) translateY(" + i + "px)", "msTransform" !== ue && (g[ue] += " translateZ(0)")
                                                } else o.top ? g.top = e.top + "px" : g.bottom = e.bottom + "px", o.left ? g.left = e.left + "px" : g.right = e.right + "px"
                                            },
                                            c = !1;
                                        if ((r.page.top || r.page.bottom) && (r.page.left || r.page.right) ? (g.position = "absolute", h(r.page, o.page)) : (r.viewport.top || r.viewport.bottom) && (r.viewport.left || r.viewport.right) ? (g.position = "fixed", h(r.viewport, o.viewport)) : "undefined" != typeof r.offset && r.offset.top && r.offset.left ? function() {
                                                g.position = "absolute";
                                                var e = s.cache("target-offsetparent", function() {
                                                    return u(s.target)
                                                });
                                                u(s.element) !== e && oe(function() {
                                                    s.element.parentNode.removeChild(s.element), e.appendChild(s.element)
                                                }), h(r.offset, o.offset), c = !0
                                            }() : (g.position = "absolute", h({
                                                top: !0,
                                                left: !0
                                            }, o.page)), !c)
                                            if (this.options.bodyElement) this.element.parentNode !== this.options.bodyElement && this.options.bodyElement.appendChild(this.element);
                                            else {
                                                for (var y = function(o) {
                                                        var e = o.ownerDocument,
                                                            t = e.fullscreenElement || e.webkitFullscreenElement || e.mozFullScreenElement || e.msFullscreenElement;
                                                        return t === o
                                                    }, b = !0, v = this.element.parentNode; v && 1 === v.nodeType && "BODY" !== v.tagName && !y(v);) {
                                                    if ("static" !== getComputedStyle(v).position) {
                                                        b = !1;
                                                        break
                                                    }
                                                    v = v.parentNode
                                                }
                                                b || (this.element.parentNode.removeChild(this.element), this.element.ownerDocument.body.appendChild(this.element))
                                            }
                                        var _ = {},
                                            S = !1;
                                        for (var e in g) {
                                            var w = g[e],
                                                T = this.element.style[e];
                                            T !== w && (S = !0, _[e] = w)
                                        }
                                        S && oe(function() {
                                            A(s.element.style, _), s.trigger("repositioned")
                                        })
                                    }
                                }
                            }]), s
                        }(ae);
                    H.modules = [], W.position = x;
                    var R = A(H, W),
                        le = function() {
                            function t(o, r) {
                                var e = [],
                                    t = !0,
                                    i = !1,
                                    a;
                                try {
                                    for (var l = o[Symbol.iterator](), c; !(t = (c = l.next()).done) && (e.push(c.value), !(r && e.length === r)); t = !0);
                                } catch (e) {
                                    i = !0, a = e
                                } finally {
                                    try {
                                        !t && l["return"] && l["return"]()
                                    } finally {
                                        if (i) throw a
                                    }
                                }
                                return e
                            }
                            return function(o, n) {
                                if (Array.isArray(o)) return o;
                                if (Symbol.iterator in Object(o)) return t(o, n);
                                throw new TypeError("Invalid attempt to destructure non-iterable instance")
                            }
                        }(),
                        h = (ce = W.Utils).getBounds,
                        A = ce.extend,
                        m = ce.updateClasses,
                        oe = ce.defer,
                        $ = ["left", "top", "right", "bottom"],
                        ce;
                    W.modules.push({
                        position: function(e) {
                            var u = this,
                                _ = e.top,
                                I = e.left,
                                O = e.targetAttachment;
                            if (!this.options.constraints) return !0;
                            var s = this.cache("element-bounds", function() {
                                    return h(u.element)
                                }),
                                C = s.height,
                                P = s.width;
                            if (0 === P && 0 === C && "undefined" != typeof this.lastSize) {
                                var t = this.lastSize;
                                P = t.width, C = t.height
                            }
                            var n = this.cache("target-bounds", function() {
                                    return u.getTargetBounds()
                                }),
                                i = n.height,
                                E = n.width,
                                a = [this.getClass("pinned"), this.getClass("out-of-bounds")];
                            this.options.constraints.forEach(function(n) {
                                var o = n.outOfBoundsClass,
                                    e = n.pinnedClass;
                                o && a.push(o), e && a.push(e)
                            }), a.forEach(function(e) {
                                ["left", "top", "right", "bottom"].forEach(function(n) {
                                    a.push(e + "-" + n)
                                })
                            });
                            var r = [],
                                o = A({}, O),
                                y = A({}, this.attachment);
                            return this.options.constraints.forEach(function(e) {
                                var n = e.to,
                                    d = e.attachment,
                                    p = e.pin;
                                "undefined" == typeof d && (d = "");
                                var f, m;
                                if (0 <= d.indexOf(" ")) {
                                    var b = d.split(" "),
                                        v = le(b, 2);
                                    m = v[0], f = v[1]
                                } else f = m = d;
                                var s = k(u, n);
                                ("target" === m || "both" === m) && (_ < s[1] && "top" === o.top && (_ += i, o.top = "bottom"), _ + C > s[3] && "bottom" === o.top && (_ -= i, o.top = "top")), "together" === m && ("top" === o.top && ("bottom" === y.top && _ < s[1] ? (_ += i, o.top = "bottom", _ += C, y.top = "top") : "top" === y.top && _ + C > s[3] && _ - (C - i) >= s[1] && (_ -= C - i, o.top = "bottom", y.top = "bottom")), "bottom" === o.top && ("top" === y.top && _ + C > s[3] ? (_ -= i, o.top = "top", _ -= C, y.top = "bottom") : "bottom" === y.top && _ < s[1] && _ + (2 * C - i) <= s[3] && (_ += C - i, o.top = "top", y.top = "top")), "middle" === o.top && (_ + C > s[3] && "top" === y.top ? (_ -= C, y.top = "bottom") : _ < s[1] && "bottom" === y.top && (_ += C, y.top = "top"))), ("target" === f || "both" === f) && (I < s[0] && "left" === o.left && (I += E, o.left = "right"), I + P > s[2] && "right" === o.left && (I -= E, o.left = "left")), "together" === f && (I < s[0] && "left" === o.left ? "right" === y.left ? (I += E, o.left = "right", I += P, y.left = "left") : "left" === y.left && (I += E, o.left = "right", I -= P, y.left = "right") : I + P > s[2] && "right" === o.left ? "left" === y.left ? (I -= E, o.left = "left", I -= P, y.left = "right") : "right" === y.left && (I -= E, o.left = "left", I += P, y.left = "left") : "center" === o.left && (I + P > s[2] && "left" === y.left ? (I -= P, y.left = "right") : I < s[0] && "right" === y.left && (I += P, y.left = "left"))), ("element" === m || "both" === m) && (_ < s[1] && "bottom" === y.top && (_ += C, y.top = "top"), _ + C > s[3] && "top" === y.top && (_ -= C, y.top = "bottom")), ("element" === f || "both" === f) && (I < s[0] && ("right" === y.left ? (I += P, y.left = "left") : "center" === y.left && (I += P / 2, y.left = "left")), I + P > s[2] && ("left" === y.left ? (I -= P, y.left = "right") : "center" === y.left && (I -= P / 2, y.left = "right"))), "string" == typeof p ? p = p.split(",").map(function(e) {
                                    return e.trim()
                                }) : !0 === p && (p = ["top", "left", "right", "bottom"]), p = p || [];
                                var a = [],
                                    l = [];
                                _ < s[1] && (0 <= p.indexOf("top") ? (_ = s[1], a.push("top")) : l.push("top")), _ + C > s[3] && (0 <= p.indexOf("bottom") ? (_ = s[3] - C, a.push("bottom")) : l.push("bottom")), I < s[0] && (0 <= p.indexOf("left") ? (I = s[0], a.push("left")) : l.push("left")), I + P > s[2] && (0 <= p.indexOf("right") ? (I = s[2] - P, a.push("right")) : l.push("right")), a.length && function() {
                                    var e;
                                    e = "undefined" == typeof u.options.pinnedClass ? u.getClass("pinned") : u.options.pinnedClass, r.push(e), a.forEach(function(n) {
                                        r.push(e + "-" + n)
                                    })
                                }(), l.length && function() {
                                    var e;
                                    e = "undefined" == typeof u.options.outOfBoundsClass ? u.getClass("out-of-bounds") : u.options.outOfBoundsClass, r.push(e), l.forEach(function(n) {
                                        r.push(e + "-" + n)
                                    })
                                }(), (0 <= a.indexOf("left") || 0 <= a.indexOf("right")) && (y.left = o.left = !1), (0 <= a.indexOf("top") || 0 <= a.indexOf("bottom")) && (y.top = o.top = !1), (o.top !== O.top || o.left !== O.left || y.top !== u.attachment.top || y.left !== u.attachment.left) && (u.updateAttachClasses(y, o), u.trigger("update", {
                                    attachment: y,
                                    targetAttachment: o
                                }))
                            }), oe(function() {
                                !1 === u.options.addTargetClasses || m(u.target, r, a), m(u.element, r, a)
                            }), {
                                top: _,
                                left: I
                            }
                        }
                    });
                    var h = (ce = W.Utils).getBounds,
                        m = ce.updateClasses,
                        oe = ce.defer,
                        ce;
                    W.modules.push({
                        position: function(f) {
                            var e = this,
                                t = f.top,
                                g = f.left,
                                n = this.cache("element-bounds", function() {
                                    return h(e.element)
                                }),
                                r = n.height,
                                o = n.width,
                                s = this.getTargetBounds(),
                                i = t + r,
                                a = g + o,
                                l = [];
                            t <= s.bottom && i >= s.top && ["left", "right"].forEach(function(t) {
                                var n = s[t];
                                (n === g || n === a) && l.push(t)
                            }), g <= s.right && a >= s.left && ["top", "bottom"].forEach(function(n) {
                                var o = s[n];
                                (o === t || o === i) && l.push(n)
                            });
                            var p = [],
                                c = [];
                            return p.push(this.getClass("abutted")), ["left", "top", "right", "bottom"].forEach(function(t) {
                                p.push(e.getClass("abutted") + "-" + t)
                            }), l.length && c.push(this.getClass("abutted")), l.forEach(function(t) {
                                c.push(e.getClass("abutted") + "-" + t)
                            }), oe(function() {
                                !1 === e.options.addTargetClasses || m(e.target, c, p), m(e.element, c, p)
                            }), !0
                        }
                    });
                    var le = function() {
                        function t(o, r) {
                            var e = [],
                                t = !0,
                                i = !1,
                                a;
                            try {
                                for (var l = o[Symbol.iterator](), c; !(t = (c = l.next()).done) && (e.push(c.value), !(r && e.length === r)); t = !0);
                            } catch (e) {
                                i = !0, a = e
                            } finally {
                                try {
                                    !t && l["return"] && l["return"]()
                                } finally {
                                    if (i) throw a
                                }
                            }
                            return e
                        }
                        return function(o, n) {
                            if (Array.isArray(o)) return o;
                            if (Symbol.iterator in Object(o)) return t(o, n);
                            throw new TypeError("Invalid attempt to destructure non-iterable instance")
                        }
                    }();
                    return W.modules.push({
                        position: function(e) {
                            var n = e.top,
                                o = e.left;
                            if (this.options.shift) {
                                var r = this.options.shift;
                                "function" == typeof this.options.shift && (r = this.options.shift.call(this, {
                                    top: n,
                                    left: o
                                }));
                                var s, i;
                                if ("string" == typeof r) {
                                    r = r.split(" "), r[1] = r[1] || r[0];
                                    var l = r,
                                        d = le(l, 2);
                                    s = d[0], i = d[1], s = parseFloat(s, 10), i = parseFloat(i, 10)
                                } else s = r.top, i = r.left;
                                return n += s, o += i, {
                                    top: n,
                                    left: o
                                }
                            }
                        }
                    }), R
                }) ? n.apply(t, []) : n) || (e.exports = n)
            },
            5: (e, o, t) => {
                var n;
                ! function(s) {
                    "use strict";

                    function i(n) {
                        var o = n.length,
                            e = l.type(n);
                        return "function" !== e && !l.isWindow(n) && (1 === n.nodeType && o || "array" === e || 0 === o || "number" == typeof o && 0 < o && o - 1 in n)
                    }
                    if (!s.jQuery) {
                        var l = function(t, n) {
                            return new l.fn.init(t, n)
                        };
                        l.isWindow = function(e) {
                            return e && e === e.window
                        }, l.type = function(e) {
                            return e ? "object" == typeof e || "function" == typeof e ? a[p.call(e)] || "object" : typeof e : e + ""
                        }, l.isArray = Array.isArray || function(e) {
                            return "array" === l.type(e)
                        }, l.isPlainObject = function(n) {
                            if (!n || "object" !== l.type(n) || n.nodeType || l.isWindow(n)) return !1;
                            try {
                                if (n.constructor && !t.call(n, "constructor") && !t.call(n.constructor.prototype, "isPrototypeOf")) return !1
                            } catch (e) {
                                return !1
                            }
                            for (var o in n);
                            return void 0 === o || t.call(n, o)
                        }, l.each = function(o, s, e) {
                            var t = 0,
                                l = o.length,
                                a = i(o);
                            if (e) {
                                if (a)
                                    for (; t < l && !1 !== s.apply(o[t], e); t++);
                                else
                                    for (t in o)
                                        if (o.hasOwnProperty(t) && !1 === s.apply(o[t], e)) break;
                            } else if (a)
                                for (; t < l && !1 !== s.call(o[t], t, o[t]); t++);
                            else
                                for (t in o)
                                    if (o.hasOwnProperty(t) && !1 === s.call(o[t], t, o[t])) break;
                            return o
                        }, l.data = function(e, s, r) {
                            if (void 0 === r) {
                                var t = e[l.expando],
                                    t = t && d[t];
                                return void 0 === s ? t : t && s in t ? t[s] : void 0
                            }
                            return void 0 === s ? void 0 : (e = e[l.expando] || (e[l.expando] = ++l.uuid), d[e] = d[e] || {}, d[e][s] = r)
                        }, l.removeData = function(e, t) {
                            var e = e[l.expando],
                                r = e && d[e];
                            r && (t ? l.each(t, function(t, n) {
                                delete r[n]
                            }) : delete d[e])
                        }, l.extend = function() {
                            var e = arguments[0] || {},
                                t = 1,
                                n = arguments.length,
                                o = !1,
                                r, s, i, p, u;
                            for ("boolean" == typeof e && (o = e, e = arguments[t] || {}, t++), "object" != typeof e && "function" !== l.type(e) && (e = {}), t === n && (e = this, t--); t < n; t++)
                                if (p = arguments[t])
                                    for (i in p) p.hasOwnProperty(i) && (u = e[i], e !== (s = p[i]) && (o && s && (l.isPlainObject(s) || (r = l.isArray(s))) ? (u = r ? (r = !1, u && l.isArray(u) ? u : []) : u && l.isPlainObject(u) ? u : {}, e[i] = l.extend(o, u, s)) : void 0 !== s && (e[i] = s)));
                            return e
                        }, l.queue = function(t, o, r) {
                            function s(t, n) {
                                return n = n || [], t && (i(Object(t)) ? function(r, o) {
                                    for (var e = +o.length, t = 0, i = r.length; t < e;) r[i++] = o[t++];
                                    if (e != e)
                                        for (; void 0 !== o[t];) r[i++] = o[t++];
                                    r.length = i
                                }(n, "string" == typeof t ? [t] : t) : [].push.call(n, t)), n
                            }
                            if (t) {
                                var n = l.data(t, o = (o || "fx") + "queue");
                                return r ? (!n || l.isArray(r) ? n = l.data(t, o, s(r)) : n.push(r), n) : n || []
                            }
                        }, l.dequeue = function(e, s) {
                            l.each(e.nodeType ? [e] : e, function(o, r) {
                                s = s || "fx";
                                var e = l.queue(r, s),
                                    t = e.shift();
                                (t = "inprogress" === t ? e.shift() : t) && ("fx" === s && e.unshift("inprogress"), t.call(r, function() {
                                    l.dequeue(r, s)
                                }))
                            })
                        }, l.fn = l.prototype = {
                            init: function(e) {
                                if (e.nodeType) return this[0] = e, this;
                                throw new Error("Not a DOM node.")
                            },
                            offset: function() {
                                var e = this[0].getBoundingClientRect ? this[0].getBoundingClientRect() : {
                                    top: 0,
                                    left: 0
                                };
                                return {
                                    top: e.top + (s.pageYOffset || document.scrollTop || 0) - (document.clientTop || 0),
                                    left: e.left + (s.pageXOffset || document.scrollLeft || 0) - (document.clientLeft || 0)
                                }
                            },
                            position: function() {
                                var r = this[0],
                                    o = function(t) {
                                        for (var n = t.offsetParent; n && "html" !== n.nodeName.toLowerCase() && n.style && "static" === n.style.position;) n = n.offsetParent;
                                        return n || document
                                    }(r),
                                    e = this.offset(),
                                    t = /^(?:body|html)$/i.test(o.nodeName) ? {
                                        top: 0,
                                        left: 0
                                    } : l(o).offset();
                                return e.top -= parseFloat(r.style.marginTop) || 0, e.left -= parseFloat(r.style.marginLeft) || 0, o.style && (t.top += parseFloat(o.style.borderTopWidth) || 0, t.left += parseFloat(o.style.borderLeftWidth) || 0), {
                                    top: e.top - t.top,
                                    left: e.left - t.left
                                }
                            }
                        };
                        var d = {};
                        l.expando = "velocity" + new Date().getTime(), l.uuid = 0;
                        for (var a = {}, t = a.hasOwnProperty, p = a.toString, n = ["Boolean", "Number", "String", "Function", "Array", "Date", "RegExp", "Object", "Error"], o = 0; o < n.length; o++) a["[object " + n[o] + "]"] = n[o].toLowerCase();
                        l.fn.init.prototype = l.fn, s.Velocity = {
                            Utilities: l
                        }
                    }
                }(window),
                function(s) {
                    "use strict";
                    "object" == typeof e.exports ? e.exports = s() : void 0 === (n = "function" == typeof(n = s) ? n.call(o, t, o, e) : n) || (e.exports = n)
                }(function() {
                    "use strict";
                    return function(t, i, d, _) {
                        function o() {
                            return Array.prototype.includes ? function(t, n) {
                                return t.includes(n)
                            } : Array.prototype.indexOf ? function(t, n) {
                                return 0 <= t.indexOf(n)
                            } : function(n, o) {
                                for (var e = 0; e < n.length; e++)
                                    if (n[e] === o) return !0;
                                return !1
                            }
                        }

                        function p(n) {
                            return H.isWrapped(n) ? n = e.call(n) : H.isNode(n) && (n = [n]), n
                        }

                        function S(e) {
                            return e = R.data(e, "velocity"), null === e ? _ : e
                        }

                        function c(e, t) {
                            e = S(e), e && e.delayTimer && !e.delayPaused && (e.delayRemaining = e.delay - t + e.delayBegin, e.delayPaused = !0, clearTimeout(e.delayTimer.setTimeout))
                        }

                        function u(e) {
                            e = S(e), e && e.delayTimer && e.delayPaused && (e.delayPaused = !1, e.delayTimer.setTimeout = setTimeout(e.delayTimer.next, e.delayRemaining))
                        }

                        function f(g, e, u, s) {
                            function a(t, n) {
                                return 1 - 3 * n + 3 * t
                            }

                            function b(n, o, e) {
                                return ((a(o, e) * n + (3 * e - 6 * o)) * n + 3 * o) * n
                            }

                            function t(n, o, e) {
                                return 3 * a(o, e) * n * n + 2 * (3 * e - 6 * o) * n + 3 * o
                            }

                            function p(n) {
                                for (var i = 0, l = 1; 10 != l && _[l] <= n; ++l) i += m;
                                var d = i + (n - _[--l]) / (_[l + 1] - _[l]) * m,
                                    a = t(d, g, u);
                                return .001 <= a ? function(n, o) {
                                    for (var i = 0, a; 4 > i; ++i) {
                                        if (a = t(o, g, u), 0 === a) return o;
                                        o -= (b(o, g, u) - n) / a
                                    }
                                    return o
                                }(n, d) : 0 === a ? d : function(t, n, r) {
                                    for (var s = 0, i, l; 0 < (i = b(l = n + (r - n) / 2, g, u) - t) ? r = l : n = l, Math.abs(i) > o && 10 > ++s;);
                                    return l
                                }(n, i, i + m)
                            }

                            function n() {
                                y = !0, g === e && u === s || function() {
                                    for (var e = 0; 11 > e; ++e) _[e] = b(e * m, g, u)
                                }()
                            }
                            var o = 1e-7,
                                m = 1 / 10,
                                c = ("Float32Array" in i);
                            if (4 !== arguments.length) return !1;
                            for (var v = 0; 4 > v; ++v)
                                if ("number" != typeof arguments[v] || isNaN(arguments[v]) || !isFinite(arguments[v])) return !1;
                            g = Math.min(g, 1), u = Math.min(u, 1), g = Math.max(g, 0), u = Math.max(u, 0);
                            var _ = new(c ? Float32Array : Array)(11),
                                y = !1;
                            c = function(t) {
                                return y || n(), g === e && u === s ? t : 0 === t ? 0 : 1 === t ? 1 : b(p(t), e, s)
                            }, c.getControlPoints = function() {
                                return [{
                                    x: g,
                                    y: e
                                }, {
                                    x: u,
                                    y: s
                                }]
                            };
                            var x = "generateBezier(" + [g, e, u, s] + ")";
                            return c.toString = function() {
                                return x
                            }, c
                        }

                        function m(e) {
                            return -e.tension * e.x - e.friction * e.v
                        }

                        function g(e, n, r) {
                            return e = {
                                x: e.x + r.dx * n,
                                v: e.v + r.dv * n,
                                tension: e.tension,
                                friction: e.friction
                            }, {
                                dx: e.v,
                                dv: m(e)
                            }
                        }

                        function O(n, o) {
                            var e = n;
                            return H.isString(n) ? $.Easings[n] || (e = !1) : e = H.isArray(n) && 1 === n.length ? function(e) {
                                return function(n) {
                                    return Math.round(n * e) * (1 / e)
                                }
                            }.apply(null, n) : H.isArray(n) && 2 === n.length ? w.apply(null, n.concat([o])) : H.isArray(n) && 4 === n.length && f.apply(null, n), e = !1 === e ? $.Easings[$.defaults.easing] ? $.defaults.easing : k : e
                        }

                        function l(n) {
                            if (n) {
                                var i = $.timestamp && !0 !== n ? n : A.now(),
                                    e = $.State.calls.length;
                                1e4 < e && ($.State.calls = function(t) {
                                    for (var o = -1, r = t ? t.length : 0, s = [], n; ++o < r;) n = t[o], n && s.push(n);
                                    return s
                                }($.State.calls), e = $.State.calls.length);
                                for (var u = 0; u < e; u++)
                                    if ($.State.calls[u]) {
                                        var f = $.State.calls[u],
                                            h = f[0],
                                            v = f[2],
                                            o = !!(w = f[3]),
                                            r = null,
                                            s = f[5],
                                            x = f[6],
                                            w = w || ($.State.calls[u][3] = i - 16);
                                        if (s) {
                                            if (!0 !== s.resume) continue;
                                            w = f[3] = Math.round(i - x - 16), f[5] = null
                                        }
                                        for (var x = f[6] = i - w, C = Math.min(x / v.duration, 1), T = 0, E = h.length; T < E; T++) {
                                            var I = h[T],
                                                p = I.element;
                                            if (S(p)) {
                                                var m = !1,
                                                    O, D, N, M, U, z;
                                                for (O in v.display !== _ && null !== v.display && "none" !== v.display && ("flex" === v.display && R.each(["-webkit-box", "-moz-box", "-ms-flexbox", "-webkit-flex"], function(t, n) {
                                                        pe.setPropertyValue(p, "display", n)
                                                    }), pe.setPropertyValue(p, "display", v.display)), v.visibility !== _ && "hidden" !== v.visibility && pe.setPropertyValue(p, "visibility", v.visibility), I) I.hasOwnProperty(O) && "element" !== O && (D = I[O], N = H.isString(D.easing) ? $.Easings[D.easing] : D.easing, z = H.isString(D.pattern) ? D.pattern.replace(/{(\d+)(!)?}/g, 1 === C ? function(t, n, o) {
                                                    return n = D.endValue[n], o ? Math.round(n) : n
                                                } : function(t, o, r) {
                                                    var s = D.startValue[o],
                                                        o = D.endValue[o] - s,
                                                        o = s + o * N(C, v, o);
                                                    return r ? Math.round(o) : o
                                                }) : 1 === C ? D.endValue : (U = D.endValue - D.startValue, D.startValue + U * N(C, v, U)), !o && z === D.currentValue || (D.currentValue = z, "tween" === O ? r = z : (pe.Hooks.registered[O] && (M = pe.Hooks.getRoot(O), (U = S(p).rootPropertyValueCache[M]) && (D.rootPropertyValue = U)), z = pe.setPropertyValue(p, O, D.currentValue + (9 > b && 0 === parseFloat(z) ? "" : D.unitType), D.rootPropertyValue, D.scrollData), pe.Hooks.registered[O] && (pe.Normalizations.registered[M] ? S(p).rootPropertyValueCache[M] = pe.Normalizations.registered[M]("extract", null, z[1]) : S(p).rootPropertyValueCache[M] = z[1]), "transform" === z[0] && (m = !0))));
                                                v.mobileHA && S(p).transformCache.translate3d === _ && (S(p).transformCache.translate3d = "(0px, 0px, 0px)", m = !0), m && pe.flushTransformCache(p)
                                            }
                                        }
                                        v.display !== _ && "none" !== v.display && ($.State.calls[u][2].display = !1), v.visibility !== _ && "hidden" !== v.visibility && ($.State.calls[u][2].visibility = !1), v.progress && v.progress.call(f[1], f[1], C, Math.max(0, w + v.duration - i), w, r), 1 === C && y(u)
                                    }
                            }
                            $.State.isTicking && q(l)
                        }

                        function y(s, a) {
                            if ($.State.calls[s]) {
                                for (var e = $.State.calls[s][0], t = $.State.calls[s][1], n = $.State.calls[s][2], i = $.State.calls[s][4], r = !1, d = 0, p = e.length, c; d < p; d++) {
                                    c = e[d].element, a || n.loop || ("none" === n.display && pe.setPropertyValue(c, "display", n.display), "hidden" === n.visibility && pe.setPropertyValue(c, "visibility", n.visibility));
                                    var u = S(c),
                                        g;
                                    if (!0 === n.loop || R.queue(c)[1] !== _ && /\.velocityQueueEntryFlag/i.test(R.queue(c)[1]) || u && (u.isAnimating = !1, g = !(u.rootPropertyValueCache = {}), R.each(pe.Lists.transforms3D, function(r, o) {
                                            var e = /^scale/.test(o) ? 1 : 0,
                                                t = u.transformCache[o];
                                            u.transformCache[o] !== _ && new RegExp("^\\(" + e + "[^.]").test(t) && (g = !0, delete u.transformCache[o])
                                        }), n.mobileHA && (g = !0, delete u.transformCache.translate3d), g && pe.flushTransformCache(c), pe.Values.removeClass(c, "velocity-animating")), !a && n.complete && !n.loop && d === p - 1) try {
                                        n.complete.call(t, t)
                                    } catch (e) {
                                        setTimeout(function() {
                                            throw e
                                        }, 1)
                                    }
                                    i && !0 !== n.loop && i(t), u && !0 === n.loop && !a && (R.each(u.tweensContainer, function(n, o) {
                                        var e;
                                        /^rotate/.test(n) && 0 == (parseFloat(o.startValue) - parseFloat(o.endValue)) % 360 && (e = o.startValue, o.startValue = o.endValue, o.endValue = e), /^backgroundPosition/.test(n) && 100 === parseFloat(o.endValue) && "%" === o.unitType && (o.endValue = 0, o.startValue = 100)
                                    }), $(c, "reverse", {
                                        loop: !0,
                                        delay: n.delay
                                    })), !1 !== n.queue && R.dequeue(c, n.queue)
                                }
                                $.State.calls[s] = !1;
                                for (var h = 0, y = $.State.calls.length; h < y; h++)
                                    if (!1 !== $.State.calls[h]) {
                                        r = !0;
                                        break
                                    }!1 == r && ($.State.isTicking = !1, delete $.State.calls, $.State.calls = [])
                            }
                        }
                        var b = function() {
                                if (d.documentMode) return d.documentMode;
                                for (var e = 7, t; 4 < e; e--)
                                    if (t = d.createElement("div"), t.innerHTML = "<!--[if IE " + e + "]><span></span><![endif]-->", t.getElementsByTagName("span").length) return t = null, e;
                                return _
                            }(),
                            h = (T = 0, i.webkitRequestAnimationFrame || i.mozRequestAnimationFrame || function(n) {
                                var o = new Date().getTime(),
                                    e = Math.max(0, 16 - (o - T));
                                return T = o + e, setTimeout(function() {
                                    n(o + e)
                                }, e)
                            }),
                            A = ("function" != typeof(n = i.performance || {}).now && (E = n.timing && n.timing.navigationStart ? n.timing.navigationStart : new Date().getTime(), n.now = function() {
                                return new Date().getTime() - E
                            }), n),
                            e = function() {
                                var e = Array.prototype.slice;
                                try {
                                    return e.call(d.documentElement), e
                                } catch (n) {
                                    return function(t, r) {
                                        var i = this.length;
                                        if ("number" != typeof t && (t = 0), "number" != typeof r && (r = i), this.slice) return e.call(this, t, r);
                                        var l = [],
                                            p = 0 <= t ? t : Math.max(0, i + t),
                                            c = (0 > r ? i + r : Math.min(r, i)) - p,
                                            o;
                                        if (0 < c)
                                            if (l = Array(c), this.charAt)
                                                for (o = 0; o < c; o++) l[o] = this.charAt(p + o);
                                            else
                                                for (o = 0; o < c; o++) l[o] = this[p + o];
                                        return l
                                    }
                                }
                            }(),
                            H = {
                                isNumber: function(e) {
                                    return "number" == typeof e
                                },
                                isString: function(e) {
                                    return "string" == typeof e
                                },
                                isArray: Array.isArray || function(e) {
                                    return "[object Array]" === Object.prototype.toString.call(e)
                                },
                                isFunction: function(e) {
                                    return "[object Function]" === Object.prototype.toString.call(e)
                                },
                                isNode: function(e) {
                                    return e && e.nodeType
                                },
                                isWrapped: function(e) {
                                    return e && e !== i && H.isNumber(e.length) && !H.isString(e) && !H.isFunction(e) && !H.isNode(e) && (0 === e.length || H.isNode(e[0]))
                                },
                                isSVG: function(e) {
                                    return i.SVGElement && e instanceof i.SVGElement
                                },
                                isEmptyObject: function(t) {
                                    for (var n in t)
                                        if (t.hasOwnProperty(n)) return !1;
                                    return !0
                                }
                            },
                            n = !1,
                            T, E, R;
                        if (t.fn && t.fn.jquery ? (R = t, n = !0) : R = i.Velocity.Utilities, 8 >= b && !n) throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");
                        if (!(7 >= b)) {
                            var k = "swing",
                                $ = {
                                    State: {
                                        isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                                        isAndroid: /Android/i.test(navigator.userAgent),
                                        isGingerbread: /Android 2\.3\.[3-7]/i.test(navigator.userAgent),
                                        isChrome: i.chrome,
                                        isFirefox: /Firefox/i.test(navigator.userAgent),
                                        prefixElement: d.createElement("div"),
                                        prefixMatches: {},
                                        scrollAnchor: null,
                                        scrollPropertyLeft: null,
                                        scrollPropertyTop: null,
                                        isTicking: !1,
                                        calls: [],
                                        delayedElements: {
                                            count: 0
                                        }
                                    },
                                    CSS: {},
                                    Utilities: R,
                                    Redirects: {},
                                    Easings: {},
                                    Promise: i.Promise,
                                    defaults: {
                                        queue: "",
                                        duration: 400,
                                        easing: "swing",
                                        begin: _,
                                        complete: _,
                                        progress: _,
                                        display: _,
                                        visibility: _,
                                        loop: !1,
                                        delay: !1,
                                        mobileHA: !0,
                                        _cacheValues: !0,
                                        promiseRejectEmpty: !0
                                    },
                                    init: function(e) {
                                        R.data(e, "velocity", {
                                            isSVG: H.isSVG(e),
                                            isAnimating: !1,
                                            computedStyle: null,
                                            tweensContainer: null,
                                            rootPropertyValueCache: {},
                                            transformCache: {}
                                        })
                                    },
                                    hook: null,
                                    mock: !1,
                                    version: {
                                        major: 1,
                                        minor: 5,
                                        patch: 0
                                    },
                                    debug: !1,
                                    timestamp: !0,
                                    pauseAll: function(t) {
                                        var r = new Date().getTime();
                                        R.each($.State.calls, function(e, n) {
                                            if (n) {
                                                if (t !== _ && (n[2].queue !== t || !1 === n[2].queue)) return !0;
                                                n[5] = {
                                                    resume: !1
                                                }
                                            }
                                        }), R.each($.State.delayedElements, function(t, n) {
                                            n && c(n, r)
                                        })
                                    },
                                    resumeAll: function(t) {
                                        new Date().getTime(), R.each($.State.calls, function(e, n) {
                                            if (n) {
                                                if (t !== _ && (n[2].queue !== t || !1 === n[2].queue)) return !0;
                                                n[5] && (n[5].resume = !0)
                                            }
                                        }), R.each($.State.delayedElements, function(t, n) {
                                            n && u(n)
                                        })
                                    }
                                };
                            i.pageYOffset === _ ? ($.State.scrollAnchor = d.documentElement || d.body.parentNode || d.body, $.State.scrollPropertyLeft = "scrollLeft", $.State.scrollPropertyTop = "scrollTop") : ($.State.scrollAnchor = i, $.State.scrollPropertyLeft = "pageXOffset", $.State.scrollPropertyTop = "pageYOffset");
                            var w = function t(n, o, r) {
                                var s = {
                                        x: -1,
                                        v: 0,
                                        tension: null,
                                        friction: null
                                    },
                                    i = [0],
                                    a = 0,
                                    l, d, p, c, u, f, h, y, b, x;
                                for (n = parseFloat(n) || 500, o = parseFloat(o) || 20, r = r || null, s.tension = n, s.friction = o, d = (l = null !== r) ? .016 * ((a = t(n, o)) / r) : .016; u = d, b = x = b = y = h = f = void 0, f = {
                                        dx: (c = p || s).v,
                                        dv: m(c)
                                    }, h = g(c, .5 * u, f), y = g(c, .5 * u, h), b = g(c, u, y), x = 1 / 6 * (f.dx + 2 * (h.dx + y.dx) + b.dx), b = 1 / 6 * (f.dv + 2 * (h.dv + y.dv) + b.dv), c.x += x * u, c.v += b * u, i.push(1 + (p = c).x), a += 16, 1e-4 < Math.abs(p.x) && 1e-4 < Math.abs(p.v););
                                return l ? function(e) {
                                    return i[0 | e * (i.length - 1)]
                                } : a
                            };
                            $.Easings = {
                                linear: function(e) {
                                    return e
                                },
                                swing: function(e) {
                                    return .5 - Math.cos(e * Math.PI) / 2
                                },
                                spring: function(e) {
                                    return 1 - Math.cos(4.5 * e * Math.PI) * Math.exp(6 * -e)
                                }
                            }, R.each([
                                ["ease", [.25, .1, .25, 1]],
                                ["ease-in", [.42, 0, 1, 1]],
                                ["ease-out", [0, 0, .58, 1]],
                                ["ease-in-out", [.42, 0, .58, 1]],
                                ["easeInSine", [.47, 0, .745, .715]],
                                ["easeOutSine", [.39, .575, .565, 1]],
                                ["easeInOutSine", [.445, .05, .55, .95]],
                                ["easeInQuad", [.55, .085, .68, .53]],
                                ["easeOutQuad", [.25, .46, .45, .94]],
                                ["easeInOutQuad", [.455, .03, .515, .955]],
                                ["easeInCubic", [.55, .055, .675, .19]],
                                ["easeOutCubic", [.215, .61, .355, 1]],
                                ["easeInOutCubic", [.645, .045, .355, 1]],
                                ["easeInQuart", [.895, .03, .685, .22]],
                                ["easeOutQuart", [.165, .84, .44, 1]],
                                ["easeInOutQuart", [.77, 0, .175, 1]],
                                ["easeInQuint", [.755, .05, .855, .06]],
                                ["easeOutQuint", [.23, 1, .32, 1]],
                                ["easeInOutQuint", [.86, 0, .07, 1]],
                                ["easeInExpo", [.95, .05, .795, .035]],
                                ["easeOutExpo", [.19, 1, .22, 1]],
                                ["easeInOutExpo", [1, 0, 0, 1]],
                                ["easeInCirc", [.6, .04, .98, .335]],
                                ["easeOutCirc", [.075, .82, .165, 1]],
                                ["easeInOutCirc", [.785, .135, .15, .86]]
                            ], function(t, n) {
                                $.Easings[n[0]] = f.apply(null, n[1])
                            });
                            var pe = $.CSS = {
                                RegEx: {
                                    isHex: /^#([A-f\d]{3}){1,2}$/i,
                                    valueUnwrap: /^[A-z]+\((.*)\)$/i,
                                    wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
                                    valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi
                                },
                                Lists: {
                                    colors: ["fill", "stroke", "stopColor", "color", "backgroundColor", "borderColor", "borderTopColor", "borderRightColor", "borderBottomColor", "borderLeftColor", "outlineColor"],
                                    transformsBase: ["translateX", "translateY", "scale", "scaleX", "scaleY", "skewX", "skewY", "rotateZ"],
                                    transforms3D: ["transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY"],
                                    units: ["%", "em", "ex", "ch", "rem", "vw", "vh", "vmin", "vmax", "cm", "mm", "Q", "in", "pc", "pt", "px", "deg", "grad", "rad", "turn", "s", "ms"],
                                    colorNames: {
                                        aliceblue: "240,248,255",
                                        antiquewhite: "250,235,215",
                                        aquamarine: "127,255,212",
                                        aqua: "0,255,255",
                                        azure: "240,255,255",
                                        beige: "245,245,220",
                                        bisque: "255,228,196",
                                        black: "0,0,0",
                                        blanchedalmond: "255,235,205",
                                        blueviolet: "138,43,226",
                                        blue: "0,0,255",
                                        brown: "165,42,42",
                                        burlywood: "222,184,135",
                                        cadetblue: "95,158,160",
                                        chartreuse: "127,255,0",
                                        chocolate: "210,105,30",
                                        coral: "255,127,80",
                                        cornflowerblue: "100,149,237",
                                        cornsilk: "255,248,220",
                                        crimson: "220,20,60",
                                        cyan: "0,255,255",
                                        darkblue: "0,0,139",
                                        darkcyan: "0,139,139",
                                        darkgoldenrod: "184,134,11",
                                        darkgray: "169,169,169",
                                        darkgrey: "169,169,169",
                                        darkgreen: "0,100,0",
                                        darkkhaki: "189,183,107",
                                        darkmagenta: "139,0,139",
                                        darkolivegreen: "85,107,47",
                                        darkorange: "255,140,0",
                                        darkorchid: "153,50,204",
                                        darkred: "139,0,0",
                                        darksalmon: "233,150,122",
                                        darkseagreen: "143,188,143",
                                        darkslateblue: "72,61,139",
                                        darkslategray: "47,79,79",
                                        darkturquoise: "0,206,209",
                                        darkviolet: "148,0,211",
                                        deeppink: "255,20,147",
                                        deepskyblue: "0,191,255",
                                        dimgray: "105,105,105",
                                        dimgrey: "105,105,105",
                                        dodgerblue: "30,144,255",
                                        firebrick: "178,34,34",
                                        floralwhite: "255,250,240",
                                        forestgreen: "34,139,34",
                                        fuchsia: "255,0,255",
                                        gainsboro: "220,220,220",
                                        ghostwhite: "248,248,255",
                                        gold: "255,215,0",
                                        goldenrod: "218,165,32",
                                        gray: "128,128,128",
                                        grey: "128,128,128",
                                        greenyellow: "173,255,47",
                                        green: "0,128,0",
                                        honeydew: "240,255,240",
                                        hotpink: "255,105,180",
                                        indianred: "205,92,92",
                                        indigo: "75,0,130",
                                        ivory: "255,255,240",
                                        khaki: "240,230,140",
                                        lavenderblush: "255,240,245",
                                        lavender: "230,230,250",
                                        lawngreen: "124,252,0",
                                        lemonchiffon: "255,250,205",
                                        lightblue: "173,216,230",
                                        lightcoral: "240,128,128",
                                        lightcyan: "224,255,255",
                                        lightgoldenrodyellow: "250,250,210",
                                        lightgray: "211,211,211",
                                        lightgrey: "211,211,211",
                                        lightgreen: "144,238,144",
                                        lightpink: "255,182,193",
                                        lightsalmon: "255,160,122",
                                        lightseagreen: "32,178,170",
                                        lightskyblue: "135,206,250",
                                        lightslategray: "119,136,153",
                                        lightsteelblue: "176,196,222",
                                        lightyellow: "255,255,224",
                                        limegreen: "50,205,50",
                                        lime: "0,255,0",
                                        linen: "250,240,230",
                                        magenta: "255,0,255",
                                        maroon: "128,0,0",
                                        mediumaquamarine: "102,205,170",
                                        mediumblue: "0,0,205",
                                        mediumorchid: "186,85,211",
                                        mediumpurple: "147,112,219",
                                        mediumseagreen: "60,179,113",
                                        mediumslateblue: "123,104,238",
                                        mediumspringgreen: "0,250,154",
                                        mediumturquoise: "72,209,204",
                                        mediumvioletred: "199,21,133",
                                        midnightblue: "25,25,112",
                                        mintcream: "245,255,250",
                                        mistyrose: "255,228,225",
                                        moccasin: "255,228,181",
                                        navajowhite: "255,222,173",
                                        navy: "0,0,128",
                                        oldlace: "253,245,230",
                                        olivedrab: "107,142,35",
                                        olive: "128,128,0",
                                        orangered: "255,69,0",
                                        orange: "255,165,0",
                                        orchid: "218,112,214",
                                        palegoldenrod: "238,232,170",
                                        palegreen: "152,251,152",
                                        paleturquoise: "175,238,238",
                                        palevioletred: "219,112,147",
                                        papayawhip: "255,239,213",
                                        peachpuff: "255,218,185",
                                        peru: "205,133,63",
                                        pink: "255,192,203",
                                        plum: "221,160,221",
                                        powderblue: "176,224,230",
                                        purple: "128,0,128",
                                        red: "255,0,0",
                                        rosybrown: "188,143,143",
                                        royalblue: "65,105,225",
                                        saddlebrown: "139,69,19",
                                        salmon: "250,128,114",
                                        sandybrown: "244,164,96",
                                        seagreen: "46,139,87",
                                        seashell: "255,245,238",
                                        sienna: "160,82,45",
                                        silver: "192,192,192",
                                        skyblue: "135,206,235",
                                        slateblue: "106,90,205",
                                        slategray: "112,128,144",
                                        snow: "255,250,250",
                                        springgreen: "0,255,127",
                                        steelblue: "70,130,180",
                                        tan: "210,180,140",
                                        teal: "0,128,128",
                                        thistle: "216,191,216",
                                        tomato: "255,99,71",
                                        turquoise: "64,224,208",
                                        violet: "238,130,238",
                                        wheat: "245,222,179",
                                        whitesmoke: "245,245,245",
                                        white: "255,255,255",
                                        yellowgreen: "154,205,50",
                                        yellow: "255,255,0"
                                    }
                                },
                                Hooks: {
                                    templates: {
                                        textShadow: ["Color X Y Blur", "black 0px 0px 0px"],
                                        boxShadow: ["Color X Y Blur Spread", "black 0px 0px 0px 0px"],
                                        clip: ["Top Right Bottom Left", "0px 0px 0px 0px"],
                                        backgroundPosition: ["X Y", "0% 0%"],
                                        transformOrigin: ["X Y Z", "50% 50% 0px"],
                                        perspectiveOrigin: ["X Y", "50% 50%"]
                                    },
                                    registered: {},
                                    register: function() {
                                        for (var e = 0, t, n, o, r, s, i; e < pe.Lists.colors.length; e++) i = "color" === pe.Lists.colors[e] ? "0 0 0 1" : "255 255 255 1", pe.Hooks.templates[pe.Lists.colors[e]] = ["Red Green Blue Alpha", i];
                                        if (b)
                                            for (t in pe.Hooks.templates) pe.Hooks.templates.hasOwnProperty(t) && (o = (n = pe.Hooks.templates[t])[0].split(" "), r = n[1].match(pe.RegEx.valueSplit), "Color" === o[0] && (o.push(o.shift()), r.push(r.shift()), pe.Hooks.templates[t] = [o.join(" "), r.join(" ")]));
                                        for (t in pe.Hooks.templates)
                                            if (pe.Hooks.templates.hasOwnProperty(t))
                                                for (var a in o = (n = pe.Hooks.templates[t])[0].split(" ")) o.hasOwnProperty(a) && (s = t + o[a], pe.Hooks.registered[s] = [t, a])
                                    },
                                    getRoot: function(t) {
                                        var n = pe.Hooks.registered[t];
                                        return n ? n[0] : t
                                    },
                                    getUnit: function(t, n) {
                                        return n = (t.substr(n || 0, 5).match(/^[a-z%]+/) || [])[0] || "", n && o(pe.Lists.units) ? n : ""
                                    },
                                    fixColors: function(e) {
                                        return e.replace(/(rgba?\(\s*)?(\b[a-z]+\b)/g, function(n, o, e) {
                                            return pe.Lists.colorNames.hasOwnProperty(e) ? (o || "rgba(") + pe.Lists.colorNames[e] + (o ? "" : ",1)") : o + e
                                        })
                                    },
                                    cleanRootPropertyValue: function(t, n) {
                                        return pe.RegEx.valueUnwrap.test(n) && (n = n.match(pe.RegEx.valueUnwrap)[1]), n = pe.Values.isCSSNullValue(n) ? pe.Hooks.templates[t][1] : n
                                    },
                                    extractValue: function(e, t) {
                                        var n = pe.Hooks.registered[e];
                                        return n ? (e = n[0], n = n[1], (t = pe.Hooks.cleanRootPropertyValue(e, t)).toString().match(pe.RegEx.valueSplit)[n]) : t
                                    },
                                    injectValue: function(e, n, r) {
                                        var i = pe.Hooks.registered[e];
                                        return i ? (e = i[0], i = i[1], (e = (r = pe.Hooks.cleanRootPropertyValue(e, r)).toString().match(pe.RegEx.valueSplit))[i] = n, e.join(" ")) : r
                                    }
                                },
                                Normalizations: {
                                    registered: {
                                        clip: function(r, o, e) {
                                            switch (r) {
                                                case "name":
                                                    return "clip";
                                                case "extract":
                                                    var t = !pe.RegEx.wrappedValueAlreadyExtracted.test(e) && (t = e.toString().match(pe.RegEx.valueUnwrap)) ? t[1].replace(/,(\s+)?/g, " ") : e;
                                                    return t;
                                                case "inject":
                                                    return "rect(" + e + ")";
                                            }
                                        },
                                        blur: function(r, o, e) {
                                            switch (r) {
                                                case "name":
                                                    return $.State.isFirefox ? "filter" : "-webkit-filter";
                                                case "extract":
                                                    var t = parseFloat(e),
                                                        i;
                                                    return t = t || 0 === t ? t : (i = e.toString().match(/blur\(([0-9]+[A-z]+)\)/i)) ? i[1] : 0;
                                                case "inject":
                                                    return parseFloat(e) ? "blur(" + e + ")" : "none";
                                            }
                                        },
                                        opacity: function(n, o, e) {
                                            if (8 >= b) switch (n) {
                                                case "name":
                                                    return "filter";
                                                case "extract":
                                                    var s = e.toString().match(/alpha\(opacity=(.*)\)/i);
                                                    return e = s ? s[1] / 100 : 1;
                                                case "inject":
                                                    return (o.style.zoom = 1) <= parseFloat(e) ? "" : "alpha(opacity=" + parseInt(100 * parseFloat(e), 10) + ")";
                                            } else switch (n) {
                                                case "name":
                                                    return "opacity";
                                                case "extract":
                                                case "inject":
                                                    return e;
                                            }
                                        }
                                    },
                                    register: function() {
                                        function a(e, r, s) {
                                            if ("border-box" === pe.getPropertyValue(r, "boxSizing").toString().toLowerCase() !== (s || !1)) return 0;
                                            for (var t = 0, e = "width" === e ? ["Left", "Right"] : ["Top", "Bottom"], i = ["padding" + e[0], "padding" + e[1], "border" + e[0] + "Width", "border" + e[1] + "Width"], l = 0, d; l < i.length; l++) d = parseFloat(pe.getPropertyValue(r, i[l])), isNaN(d) || (t += d);
                                            return s ? -t : t
                                        }

                                        function e(n, o) {
                                            return function(s, r, e) {
                                                return "name" === s ? n : "extract" === s ? parseFloat(e) + a(n, r, o) : "inject" === s ? parseFloat(e) - a(n, r, o) + "px" : void 0
                                            }
                                        }
                                        b && !(9 < b) || $.State.isGingerbread || (pe.Lists.transformsBase = pe.Lists.transformsBase.concat(pe.Lists.transforms3D));
                                        for (var t = 0; t < pe.Lists.transformsBase.length; t++) ! function() {
                                            var n = pe.Lists.transformsBase[t];
                                            pe.Normalizations.registered[n] = function(o, r, e) {
                                                switch (o) {
                                                    case "name":
                                                        return "transform";
                                                    case "extract":
                                                        return S(r) === _ || S(r).transformCache[n] === _ ? /^scale/i.test(n) ? 1 : 0 : S(r).transformCache[n].replace(/[()]/g, "");
                                                    case "inject":
                                                        var i = !1;
                                                        switch (n.substr(0, n.length - 1)) {
                                                            case "translate":
                                                                i = !/(%|px|em|rem|vw|vh|\d)$/i.test(e);
                                                                break;
                                                            case "scal":
                                                            case "scale":
                                                                $.State.isAndroid && S(r).transformCache[n] === _ && 1 > e && (e = 1), i = !/(\d)$/i.test(e);
                                                                break;
                                                            case "skew":
                                                            case "rotate":
                                                                i = !/(deg|\d)$/i.test(e);
                                                        }
                                                        return i || (S(r).transformCache[n] = "(" + e + ")"), S(r).transformCache[n];
                                                }
                                            }
                                        }();
                                        for (var o = 0; o < pe.Lists.colors.length; o++) ! function() {
                                            var e = pe.Lists.colors[o];
                                            pe.Normalizations.registered[e] = function(t, n, o) {
                                                switch (t) {
                                                    case "name":
                                                        return e;
                                                    case "extract":
                                                        var r = pe.RegEx.wrappedValueAlreadyExtracted.test(o) ? o : (i = {
                                                                black: "rgb(0, 0, 0)",
                                                                blue: "rgb(0, 0, 255)",
                                                                gray: "rgb(128, 128, 128)",
                                                                green: "rgb(0, 128, 0)",
                                                                red: "rgb(255, 0, 0)",
                                                                white: "rgb(255, 255, 255)"
                                                            }, /^[A-z]+$/i.test(o) ? r = i[o] === _ ? i.black : i[o] : pe.RegEx.isHex.test(o) ? r = "rgb(" + pe.Values.hexToRgb(o).join(" ") + ")" : /^rgba?\(/i.test(o) || (r = i.black), (r || o).toString().match(pe.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ")),
                                                            i;
                                                        return (!b || 8 < b) && 3 === r.split(" ").length && (r += " 1"), r;
                                                    case "inject":
                                                        return /^rgb/.test(o) ? o : (8 >= b ? 4 === o.split(" ").length && (o = o.split(/\s+/).slice(0, 3).join(" ")) : 3 === o.split(" ").length && (o += " 1"), (8 >= b ? "rgb" : "rgba") + "(" + o.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")");
                                                }
                                            }
                                        }();
                                        pe.Normalizations.registered.innerWidth = e("width", !0), pe.Normalizations.registered.innerHeight = e("height", !0), pe.Normalizations.registered.outerWidth = e("width"), pe.Normalizations.registered.outerHeight = e("height")
                                    }
                                },
                                Names: {
                                    camelCase: function(e) {
                                        return e.replace(/-(\w)/g, function(t, n) {
                                            return n.toUpperCase()
                                        })
                                    },
                                    SVGAttribute: function(t) {
                                        var n = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";
                                        return (b || $.State.isAndroid && !$.State.isChrome) && (n += "|transform"), new RegExp("^(" + n + ")$", "i").test(t)
                                    },
                                    prefixCheck: function(n) {
                                        if ($.State.prefixMatches[n]) return [$.State.prefixMatches[n], !0];
                                        for (var o = ["", "Webkit", "Moz", "ms", "O"], e = 0, r = o.length, s; e < r; e++)
                                            if (s = 0 == e ? n : o[e] + n.replace(/^\w/, function(e) {
                                                    return e.toUpperCase()
                                                }), H.isString($.State.prefixElement.style[s])) return [$.State.prefixMatches[n] = s, !0];
                                        return [n, !1]
                                    }
                                },
                                Values: {
                                    hexToRgb: function(e) {
                                        return e = e.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i, function(r, o, e, t) {
                                            return o + o + e + e + t + t
                                        }), (e = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e)) ? [parseInt(e[1], 16), parseInt(e[2], 16), parseInt(e[3], 16)] : [0, 0, 0]
                                    },
                                    isCSSNullValue: function(e) {
                                        return !e || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(e)
                                    },
                                    getUnitType: function(e) {
                                        return /^(rotate|skew)/i.test(e) ? "deg" : /(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(e) ? "" : "px"
                                    },
                                    getDisplayType: function(e) {
                                        return e = e && e.tagName.toString().toLowerCase(), /^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(e) ? "inline" : /^(li)$/i.test(e) ? "list-item" : /^(tr)$/i.test(e) ? "table-row" : /^(table)$/i.test(e) ? "table" : /^(tbody)$/i.test(e) ? "table-row-group" : "block"
                                    },
                                    addClass: function(n, o) {
                                        var e;
                                        n && (n.classList ? n.classList.add(o) : H.isString(n.className) ? n.className += (n.className.length ? " " : "") + o : (e = n.getAttribute(7 >= b ? "className" : "class") || "", n.setAttribute("class", e + (e ? " " : "") + o)))
                                    },
                                    removeClass: function(n, o) {
                                        var e;
                                        n && (n.classList ? n.classList.remove(o) : H.isString(n.className) ? n.className = n.className.toString().replace(new RegExp("(^|\\s)" + o.split(" ").join("|") + "(\\s|$)", "gi"), " ") : (e = n.getAttribute(7 >= b ? "className" : "class") || "", n.setAttribute("class", e.replace(new RegExp("(^|s)" + o.split(" ").join("|") + "(s|$)", "gi"), " "))))
                                    }
                                },
                                getPropertyValue: function(n, o, e, r) {
                                    function s(t, n) {
                                        var a = 0;
                                        if (8 >= b) a = R.css(t, n);
                                        else {
                                            var l = !1;
                                            /^(width|height)$/.test(n) && 0 === pe.getPropertyValue(t, "display") && (l = !0, pe.setPropertyValue(t, "display", pe.Values.getDisplayType(t)));
                                            var d = function() {
                                                l && pe.setPropertyValue(t, "display", "none")
                                            };
                                            if (!r) {
                                                if ("height" === n && "border-box" !== pe.getPropertyValue(t, "boxSizing").toString().toLowerCase()) {
                                                    var g = t.offsetHeight - (parseFloat(pe.getPropertyValue(t, "borderTopWidth")) || 0) - (parseFloat(pe.getPropertyValue(t, "borderBottomWidth")) || 0) - (parseFloat(pe.getPropertyValue(t, "paddingTop")) || 0) - (parseFloat(pe.getPropertyValue(t, "paddingBottom")) || 0);
                                                    return d(), g
                                                }
                                                if ("width" === n && "border-box" !== pe.getPropertyValue(t, "boxSizing").toString().toLowerCase()) {
                                                    var f = t.offsetWidth - (parseFloat(pe.getPropertyValue(t, "borderLeftWidth")) || 0) - (parseFloat(pe.getPropertyValue(t, "borderRightWidth")) || 0) - (parseFloat(pe.getPropertyValue(t, "paddingLeft")) || 0) - (parseFloat(pe.getPropertyValue(t, "paddingRight")) || 0);
                                                    return d(), f
                                                }
                                            }
                                            f = S(t) === _ ? i.getComputedStyle(t, null) : S(t).computedStyle ? S(t).computedStyle : S(t).computedStyle = i.getComputedStyle(t, null), "borderColor" === n && (n = "borderTopColor"), "" !== (a = 9 === b && "filter" === n ? f.getPropertyValue(n) : f[n]) && null !== a || (a = t.style[n]), d()
                                        }
                                        return "auto" !== a || !/^(top|right|bottom|left)$/i.test(n) || ("fixed" === (d = s(t, "position")) || "absolute" === d && /top|left/i.test(n)) && (a = R(t).position()[n] + "px"), a
                                    }
                                    var a, d;
                                    if (pe.Hooks.registered[o] ? (d = pe.Hooks.getRoot(a = o), e === _ && (e = pe.getPropertyValue(n, pe.Names.prefixCheck(d)[0])), pe.Normalizations.registered[d] && (e = pe.Normalizations.registered[d]("extract", n, e)), a = pe.Hooks.extractValue(a, e)) : pe.Normalizations.registered[o] && ("transform" !== (e = pe.Normalizations.registered[o]("name", n)) && (u = s(n, pe.Names.prefixCheck(e)[0]), pe.Values.isCSSNullValue(u) && pe.Hooks.templates[o] && (u = pe.Hooks.templates[o][1])), a = pe.Normalizations.registered[o]("extract", n, u)), !/^[\d-]/.test(a)) {
                                        var u = S(n);
                                        if (!(u && u.isSVG && pe.Names.SVGAttribute(o))) a = s(n, pe.Names.prefixCheck(o)[0]);
                                        else if (/^(height|width)$/i.test(o)) try {
                                            a = n.getBBox()[o]
                                        } catch (e) {
                                            a = 0
                                        } else a = n.getAttribute(o)
                                    }
                                    return pe.Values.isCSSNullValue(a) && (a = 0), $.debug, a
                                },
                                setPropertyValue: function(t, n, o, r, s) {
                                    var a = n;
                                    if ("scroll" === n) s.container ? s.container["scroll" + s.direction] = o : "Left" === s.direction ? i.scrollTo(o, s.alternateValue) : i.scrollTo(s.alternateValue, o);
                                    else if (pe.Normalizations.registered[n] && "transform" === pe.Normalizations.registered[n]("name", t)) pe.Normalizations.registered[n]("inject", t, o), a = "transform", o = S(t).transformCache[n];
                                    else {
                                        if (pe.Hooks.registered[n] && (f = pe.Hooks.getRoot(s = n), r = r || pe.getPropertyValue(t, f), o = pe.Hooks.injectValue(s, o, r), n = f), pe.Normalizations.registered[n] && (o = pe.Normalizations.registered[n]("inject", t, o), n = pe.Normalizations.registered[n]("name", t)), a = pe.Names.prefixCheck(n)[0], 8 >= b) try {
                                            t.style[a] = o
                                        } catch (e) {
                                            $.debug
                                        } else {
                                            var f = S(t);
                                            f && f.isSVG && pe.Names.SVGAttribute(n) ? t.setAttribute(n, o) : t.style[a] = o
                                        }
                                        $.debug
                                    }
                                    return [a, o]
                                },
                                flushTransformCache: function(e) {
                                    var o = "",
                                        n = S(e),
                                        r, s, i;
                                    (b || $.State.isAndroid && !$.State.isChrome) && n && n.isSVG ? (r = {
                                        translate: [(n = function(n) {
                                            return parseFloat(pe.getPropertyValue(e, n))
                                        })("translateX"), n("translateY")],
                                        skewX: [n("skewX")],
                                        skewY: [n("skewY")],
                                        scale: 1 === n("scale") ? [n("scaleX"), n("scaleY")] : [n("scale"), n("scale")],
                                        rotate: [n("rotateZ"), 0, 0]
                                    }, R.each(S(e).transformCache, function(e) {
                                        /^translate/i.test(e) ? e = "translate" : /^scale/i.test(e) ? e = "scale" : /^rotate/i.test(e) && (e = "rotate"), r[e] && (o += e + "(" + r[e].join(" ") + ") ", delete r[e])
                                    })) : (R.each(S(e).transformCache, function(t) {
                                        return s = S(e).transformCache[t], "transformPerspective" === t ? (i = s, !0) : void(o += (t = 9 === b && "rotateZ" === t ? "rotate" : t) + s + " ")
                                    }), i && (o = "perspective" + i + " " + o)), pe.setPropertyValue(e, "transform", o)
                                }
                            };
                            pe.Hooks.register(), pe.Normalizations.register(), $.hook = function(e, n, s) {
                                var i;
                                return e = p(e), R.each(e, function(r, o) {
                                    var e;
                                    S(o) === _ && $.init(o), s === _ ? i === _ && (i = pe.getPropertyValue(o, n)) : ("transform" === (e = pe.setPropertyValue(o, n, s))[0] && $.CSS.flushTransformCache(o), i = e)
                                }), i
                            };
                            var s = function() {
                                function t() {
                                    return e ? q.promise || null : f
                                }

                                function a(s, e) {
                                    function t() {
                                        var v, t, n, r, T, I, L, F;
                                        if (a.begin && 0 === k) try {
                                            a.begin.call(h, h)
                                        } catch (e) {
                                            setTimeout(function() {
                                                throw e
                                            }, 1)
                                        }
                                        if ("scroll" === Q) {
                                            var M = /^x$/i.test(a.axis) ? "Left" : "Top",
                                                z = parseFloat(a.offset) || 0,
                                                u, Y, K;
                                            a.container ? H.isWrapped(a.container) || H.isNode(a.container) ? (a.container = a.container[0] || a.container, K = (u = a.container["scroll" + M]) + R(s).position()[M.toLowerCase()] + z) : a.container = null : (u = $.State.scrollAnchor[$.State["scrollProperty" + M]], Y = $.State.scrollAnchor[$.State["scrollProperty" + ("Left" === M ? "Top" : "Left")]], K = R(s).offset()[M.toLowerCase()] + z), p = {
                                                scroll: {
                                                    rootPropertyValue: !1,
                                                    startValue: u,
                                                    currentValue: u,
                                                    endValue: K,
                                                    unitType: "",
                                                    easing: a.easing,
                                                    scrollData: {
                                                        container: a.container,
                                                        direction: M,
                                                        alternateValue: Y
                                                    }
                                                },
                                                element: s
                                            }, $.debug
                                        } else if ("reverse" === Q) {
                                            if (!(v = S(s))) return;
                                            if (!v.tweensContainer) return void R.dequeue(s, a.queue);
                                            for (var G in "none" === v.opts.display && (v.opts.display = "auto"), "hidden" === v.opts.visibility && (v.opts.visibility = "visible"), v.opts.loop = !1, v.opts.begin = null, v.opts.complete = null, E.easing || delete a.easing, E.duration || delete a.duration, a = R.extend({}, v.opts, a), t = R.extend(!0, {}, v ? v.tweensContainer : null)) t.hasOwnProperty(G) && "element" !== G && (n = t[G].startValue, t[G].startValue = t[G].currentValue = t[G].endValue, t[G].endValue = n, H.isEmptyObject(E) || (t[G].easing = a.easing), $.debug);
                                            p = t
                                        } else if ("start" === Q) {
                                            (v = S(s)) && v.tweensContainer && !0 === v.isAnimating && (t = v.tweensContainer);
                                            var X = function(n, r) {
                                                    var l = pe.Hooks.getRoot(n),
                                                        u = !1,
                                                        f = r[0],
                                                        g = r[1],
                                                        m = r[2];
                                                    if (v && v.isSVG || "tween" === l || !1 !== pe.Names.prefixCheck(l)[1] || pe.Normalizations.registered[l] !== _) {
                                                        (a.display !== _ && null !== a.display && "none" !== a.display || a.visibility !== _ && "hidden" !== a.visibility) && /opacity|filter/.test(n) && !m && 0 !== f && (m = 0), a._cacheValues && t && t[n] ? (m === _ && (m = t[n].endValue + t[n].unitType), u = v.rootPropertyValueCache[l]) : pe.Hooks.registered[n] ? m === _ ? (u = pe.getPropertyValue(s, l), m = pe.getPropertyValue(s, n, u)) : u = pe.Hooks.templates[l][1] : m === _ && (m = pe.getPropertyValue(s, n));
                                                        var y = !1,
                                                            r = function(t, n) {
                                                                var n = (n || "0").toString().toLowerCase().replace(/[%A-z]+$/, function(e) {
                                                                        return o = e, ""
                                                                    }),
                                                                    o = o || pe.Values.getUnitType(t);
                                                                return [n, o]
                                                            },
                                                            b, x;
                                                        if (m !== f && H.isString(m) && H.isString(f)) {
                                                            for (var S = "", w = 0, C = 0, T = [], k = [], h = 0, I = 0, D = 0, m = pe.Hooks.fixColors(m), f = pe.Hooks.fixColors(f); w < m.length && C < f.length;) {
                                                                var N = m[w],
                                                                    j = f[C];
                                                                if (/[\d\.-]/.test(N) && /[\d\.-]/.test(j)) {
                                                                    for (var L = N, B = j, F = ".", U = "."; ++w < m.length;) {
                                                                        if ((N = m[w]) === F) F = "..";
                                                                        else if (!/\d/.test(N)) break;
                                                                        L += N
                                                                    }
                                                                    for (; ++C < f.length;) {
                                                                        if ((j = f[C]) === U) U = "..";
                                                                        else if (!/\d/.test(j)) break;
                                                                        B += j
                                                                    }
                                                                    var K = pe.Hooks.getUnit(m, w),
                                                                        G = pe.Hooks.getUnit(f, C),
                                                                        E, X;
                                                                    w += K.length, C += G.length, K === G ? L === B ? S += L + K : (S += "{" + T.length + (I ? "!" : "") + "}" + K, T.push(parseFloat(L)), k.push(parseFloat(B))) : (E = parseFloat(L), X = parseFloat(B), S += (5 > h ? "calc" : "") + "(" + (E ? "{" + T.length + (I ? "!" : "") + "}" : "0") + K + " + " + (X ? "{" + (T.length + (E ? 1 : 0)) + (I ? "!" : "") + "}" : "0") + G + ")", E && (T.push(E), k.push(0)), X && (T.push(0), k.push(X)))
                                                                } else {
                                                                    if (N !== j) {
                                                                        h = 0;
                                                                        break
                                                                    }
                                                                    S += N, w++, C++, 0 === h && "c" === N || 1 === h && "a" === N || 2 === h && "l" === N || 3 === h && "c" === N || 4 <= h && "(" === N ? h++ : (h && 5 > h || 4 <= h && ")" === N && 5 > --h) && (h = 0), 0 === I && "r" === N || 1 === I && "g" === N || 2 === I && "b" === N || 3 === I && "a" === N || 3 <= I && "(" === N ? (3 === I && "a" === N && (D = 1), I++) : D && "," === N ? 3 < ++D && (I = D = 0) : (D && I < (D ? 5 : 4) || (D ? 4 : 3) <= I && ")" === N && --I < (D ? 5 : 4)) && (I = D = 0)
                                                                }
                                                            }
                                                            w === m.length && C === f.length || ($.debug, S = _), S && (T.length ? ($.debug, m = T, f = k, b = x = "") : S = _)
                                                        }
                                                        if (S || (m = (l = r(n, m))[0], x = l[1], f = (l = r(n, f))[0].replace(/^([+-\/*])=/, function(t, n) {
                                                                return y = n, ""
                                                            }), b = l[1], m = parseFloat(m) || 0, f = parseFloat(f) || 0, "%" === b && (/^(fontSize|lineHeight)$/.test(n) ? (f /= 100, b = "em") : /^scale/.test(n) ? (f /= 100, b = "") : /(Red|Green|Blue)$/i.test(n) && (f = 255 * (f / 100), b = ""))), /[\/*]/.test(y)) b = x;
                                                        else if (x !== b && 0 !== m)
                                                            if (0 === f) b = x;
                                                            else {
                                                                c = c || function() {
                                                                    var a = {
                                                                            myParent: s.parentNode || d.body,
                                                                            position: pe.getPropertyValue(s, "position"),
                                                                            fontSize: pe.getPropertyValue(s, "fontSize")
                                                                        },
                                                                        o = a.position === P.lastPosition && a.myParent === P.lastParent,
                                                                        e = a.fontSize === P.lastFontSize;
                                                                    P.lastParent = a.myParent, P.lastPosition = a.position, P.lastFontSize = a.fontSize;
                                                                    var t = {},
                                                                        l;
                                                                    return e && o ? (t.emToPx = P.lastEmToPx, t.percentToPxWidth = P.lastPercentToPxWidth, t.percentToPxHeight = P.lastPercentToPxHeight) : (l = v && v.isSVG ? d.createElementNS("http://www.w3.org/2000/svg", "rect") : d.createElement("div"), $.init(l), a.myParent.appendChild(l), R.each(["overflow", "overflowX", "overflowY"], function(t, n) {
                                                                        $.CSS.setPropertyValue(l, n, "hidden")
                                                                    }), $.CSS.setPropertyValue(l, "position", a.position), $.CSS.setPropertyValue(l, "fontSize", a.fontSize), $.CSS.setPropertyValue(l, "boxSizing", "content-box"), R.each(["minWidth", "maxWidth", "width", "minHeight", "maxHeight", "height"], function(t, n) {
                                                                        $.CSS.setPropertyValue(l, n, "100%")
                                                                    }), $.CSS.setPropertyValue(l, "paddingLeft", "100em"), t.percentToPxWidth = P.lastPercentToPxWidth = (parseFloat(pe.getPropertyValue(l, "width", null, !0)) || 1) / 100, t.percentToPxHeight = P.lastPercentToPxHeight = (parseFloat(pe.getPropertyValue(l, "height", null, !0)) || 1) / 100, t.emToPx = P.lastEmToPx = (parseFloat(pe.getPropertyValue(l, "paddingLeft")) || 1) / 100, a.myParent.removeChild(l)), null === P.remToPx && (P.remToPx = parseFloat(pe.getPropertyValue(d.body, "fontSize")) || 16), null === P.vwToPx && (P.vwToPx = parseFloat(i.innerWidth) / 100, P.vhToPx = parseFloat(i.innerHeight) / 100), t.remToPx = P.remToPx, t.vwToPx = P.vwToPx, t.vhToPx = P.vhToPx, $.debug, t
                                                                }();
                                                                var ae = /margin|padding|left|right|width|text|word|letter/i.test(n) || /X$/.test(n) || "x" === n ? "x" : "y";
                                                                switch (x) {
                                                                    case "%":
                                                                        m *= "x" == ae ? c.percentToPxWidth : c.percentToPxHeight;
                                                                        break;
                                                                    case "px":
                                                                        break;
                                                                    default:
                                                                        m *= c[x + "ToPx"];
                                                                }
                                                                switch (b) {
                                                                    case "%":
                                                                        m *= 1 / ("x" == ae ? c.percentToPxWidth : c.percentToPxHeight);
                                                                        break;
                                                                    case "px":
                                                                        break;
                                                                    default:
                                                                        m *= 1 / c[b + "ToPx"];
                                                                }
                                                            }
                                                        "+" === y ? f = m + f : "-" === y ? f = m - f : "*" === y ? f *= m : "/" === y ? f = m / f : void 0, p[n] = {
                                                            rootPropertyValue: u,
                                                            startValue: m,
                                                            currentValue: m,
                                                            endValue: f,
                                                            unitType: b,
                                                            easing: g
                                                        }, S && (p[n].pattern = S), $.debug
                                                    } else $.debug
                                                },
                                                ee;
                                            for (ee in B)
                                                if (B.hasOwnProperty(ee)) {
                                                    var se = pe.Names.camelCase(ee),
                                                        ne = (r = B[ee], F = L = I = T = void 0, H.isFunction(r) && (r = r.call(s, e, U)), H.isArray(r) ? (I = r[0], F = !H.isArray(r[1]) && /^[\d-]/.test(r[1]) || H.isFunction(r[1]) || pe.RegEx.isHex.test(r[1]) ? r[1] : H.isString(r[1]) && !pe.RegEx.isHex.test(r[1]) && $.Easings[r[1]] || H.isArray(r[1]) ? (L = T ? r[1] : O(r[1], a.duration), r[2]) : r[1] || r[2]) : I = r, T || (L = L || a.easing), [(I = H.isFunction(I) ? I.call(s, e, U) : I) || 0, L, F = H.isFunction(F) ? F.call(s, e, U) : F]);
                                                    if (o(pe.Lists.colors)) {
                                                        var m = ne[0],
                                                            g = ne[1],
                                                            y = ne[2];
                                                        if (pe.RegEx.isHex.test(m)) {
                                                            for (var oe = ["Red", "Green", "Blue"], b = pe.Values.hexToRgb(m), w = y ? pe.Values.hexToRgb(y) : _, x = 0, ae; x < oe.length; x++) ae = [b[x]], g && ae.push(g), w !== _ && ae.push(w[x]), X(se + oe[x], ae);
                                                            continue
                                                        }
                                                    }
                                                    X(se, ne)
                                                }
                                            p.element = s
                                        }
                                        p.element && (pe.Values.addClass(s, "velocity-animating"), D.push(p), (v = S(s)) && ("" === a.queue && (v.tweensContainer = p, v.opts = a), v.isAnimating = !0), k === U - 1 ? ($.State.calls.push([D, h, a, null, q.resolver, null, 0]), !1 === $.State.isTicking && ($.State.isTicking = !0, l())) : k++)
                                    }
                                    var a = R.extend({}, $.defaults, E),
                                        p = {},
                                        c, u, f;
                                    switch (S(s) === _ && $.init(s), parseFloat(a.delay) && !1 !== a.queue && R.queue(s, a.queue, function(t) {
                                        $.velocityQueueEntryFlag = !0;
                                        var n = $.State.delayedElements.count++;
                                        $.State.delayedElements[n] = s;
                                        var n = (o = n, function() {
                                                $.State.delayedElements[o] = !1, t()
                                            }),
                                            o;
                                        S(s).delayBegin = new Date().getTime(), S(s).delay = parseFloat(a.delay), S(s).delayTimer = {
                                            setTimeout: setTimeout(t, parseFloat(a.delay)),
                                            next: n
                                        }
                                    }), a.duration.toString().toLowerCase()) {
                                        case "fast":
                                            a.duration = 200;
                                            break;
                                        case "normal":
                                            a.duration = 400;
                                            break;
                                        case "slow":
                                            a.duration = 600;
                                            break;
                                        default:
                                            a.duration = parseFloat(a.duration) || 1;
                                    }!1 !== $.mock && (!0 === $.mock ? a.duration = a.delay = 1 : (a.duration *= parseFloat($.mock) || 1, a.delay *= parseFloat($.mock) || 1)), a.easing = O(a.easing, a.duration), a.begin && !H.isFunction(a.begin) && (a.begin = null), a.progress && !H.isFunction(a.progress) && (a.progress = null), a.complete && !H.isFunction(a.complete) && (a.complete = null), a.display !== _ && null !== a.display && (a.display = a.display.toString().toLowerCase(), "auto" === a.display && (a.display = $.CSS.Values.getDisplayType(s))), a.visibility !== _ && null !== a.visibility && (a.visibility = a.visibility.toString().toLowerCase()), a.mobileHA = a.mobileHA && $.State.isMobile && !$.State.isGingerbread, !1 === a.queue ? a.delay ? (u = $.State.delayedElements.count++, $.State.delayedElements[u] = s, f = u, u = function() {
                                        $.State.delayedElements[f] = !1, t()
                                    }, S(s).delayBegin = new Date().getTime(), S(s).delay = parseFloat(a.delay), S(s).delayTimer = {
                                        setTimeout: setTimeout(t, parseFloat(a.delay)),
                                        next: u
                                    }) : t() : R.queue(s, a.queue, function(o, n) {
                                        return !0 === n ? (q.promise && q.resolver(h), !0) : ($.velocityQueueEntryFlag = !0, void t())
                                    }), "" !== a.queue && "fx" !== a.queue || "inprogress" === R.queue(s)[0] || R.dequeue(s)
                                }
                                var n = arguments[0] && (arguments[0].p || R.isPlainObject(arguments[0].properties) && !arguments[0].properties.names || H.isString(arguments[0].properties)),
                                    e, f, g, h, B;
                                H.isWrapped(this) ? (e = !1, g = 0, f = h = this) : (e = !0, g = 1, h = n ? arguments[0].elements || arguments[0].e : arguments[0]);
                                var q = {
                                    promise: null,
                                    resolver: null,
                                    rejecter: null
                                };
                                if (e && $.Promise && (q.promise = new $.Promise(function(t, n) {
                                        q.resolver = t, q.rejecter = n
                                    })), E = n ? (B = arguments[0].properties || arguments[0].p, arguments[0].options || arguments[0].o) : (B = arguments[g], arguments[g + 1]), h = p(h)) {
                                    var U = h.length,
                                        k = 0,
                                        Q;
                                    if (!/^(stop|finish|finishAll|pause|resume)$/i.test(B) && !R.isPlainObject(E))
                                        for (var E = {}, A = g + 1; A < arguments.length; A++) !H.isArray(arguments[A]) && (/^(fast|normal|slow)$/i.test(arguments[A]) || /^\d/.test(arguments[A])) ? E.duration = arguments[A] : H.isString(arguments[A]) || H.isArray(arguments[A]) ? E.easing = arguments[A] : H.isFunction(arguments[A]) && (E.complete = arguments[A]);
                                    switch (B) {
                                        case "scroll":
                                            Q = "scroll";
                                            break;
                                        case "reverse":
                                            Q = "reverse";
                                            break;
                                        case "pause":
                                            var L = new Date().getTime();
                                            return R.each(h, function(t, n) {
                                                c(n, L)
                                            }), R.each($.State.calls, function(e, t) {
                                                var o = !1;
                                                t && R.each(t[1], function(n, r) {
                                                    var s = E === _ ? "" : E;
                                                    return !0 !== s && t[2].queue !== s && (E !== _ || !1 !== t[2].queue) || (R.each(h, function(s, n) {
                                                        if (n === r) return t[5] = {
                                                            resume: !1
                                                        }, !(o = !0)
                                                    }), !o && void 0)
                                                })
                                            }), t();
                                        case "resume":
                                            return R.each(h, function(t, n) {
                                                u(n)
                                            }), R.each($.State.calls, function(e, t) {
                                                var o = !1;
                                                t && R.each(t[1], function(n, r) {
                                                    var s = E === _ ? "" : E;
                                                    return !0 !== s && t[2].queue !== s && (E !== _ || !1 !== t[2].queue) || !t[5] || (R.each(h, function(s, n) {
                                                        if (n === r) return t[5].resume = !0, !(o = !0)
                                                    }), !o && void 0)
                                                })
                                            }), t();
                                        case "finish":
                                        case "finishAll":
                                        case "stop":
                                            R.each(h, function(t, n) {
                                                S(n) && S(n).delayTimer && (clearTimeout(S(n).delayTimer.setTimeout), S(n).delayTimer.next && S(n).delayTimer.next(), delete S(n).delayTimer), "finishAll" === B && (!0 === E || H.isString(E)) && (R.each(R.queue(n, H.isString(E) ? E : ""), function(t, n) {
                                                    H.isFunction(n) && n()
                                                }), R.queue(n, H.isString(E) ? E : "", []))
                                            });
                                            var w = [];
                                            return R.each($.State.calls, function(t, s) {
                                                s && R.each(s[1], function(e, r) {
                                                    var o = E === _ ? "" : E;
                                                    return !0 !== o && s[2].queue !== o && (E !== _ || !1 !== s[2].queue) || void R.each(h, function(n, i) {
                                                        i === r && (!0 !== E && !H.isString(E) || (R.each(R.queue(i, H.isString(E) ? E : ""), function(t, n) {
                                                            H.isFunction(n) && n(null, !0)
                                                        }), R.queue(i, H.isString(E) ? E : "", [])), "stop" === B ? ((i = S(i)) && i.tweensContainer && !1 !== o && R.each(i.tweensContainer, function(t, n) {
                                                            n.endValue = n.currentValue
                                                        }), w.push(t)) : "finish" !== B && "finishAll" !== B || (s[2].duration = 1))
                                                    })
                                                })
                                            }), "stop" === B && (R.each(w, function(t, n) {
                                                y(n, !0)
                                            }), q.promise && q.resolver(h)), t();
                                        default:
                                            if (!R.isPlainObject(B) || H.isEmptyObject(B)) {
                                                if (H.isString(B) && $.Redirects[B]) {
                                                    var V = (T = R.extend({}, E)).duration,
                                                        C = T.delay || 0,
                                                        T;
                                                    return !0 === T.backwards && (h = R.extend(!0, [], h).reverse()), R.each(h, function(t, n) {
                                                        parseFloat(T.stagger) ? T.delay = C + parseFloat(T.stagger) * t : H.isFunction(T.stagger) && (T.delay = C + T.stagger.call(n, t, U)), T.drag && (T.duration = parseFloat(V) || (/^(callout|transition)/.test(B) ? 1e3 : 400), T.duration = Math.max(T.duration * (T.backwards ? 1 - t / U : (t + 1) / U), .75 * T.duration, 200)), $.Redirects[B].call(n, n, T || {}, t, U, h, q.promise ? q : _)
                                                    }), t()
                                                }
                                                var W = "Velocity: First argument (" + B + ") was not a property map, a known action, or a registered redirect. Aborting.";
                                                return q.promise ? q.rejecter(new Error(W)) : i.console, t()
                                            }
                                            Q = "start";
                                    }
                                    var P = {
                                            lastParent: null,
                                            lastPosition: null,
                                            lastFontSize: null,
                                            lastPercentToPxWidth: null,
                                            lastPercentToPxHeight: null,
                                            lastEmToPx: null,
                                            remToPx: null,
                                            vwToPx: null,
                                            vhToPx: null
                                        },
                                        D = [];
                                    R.each(h, function(t, n) {
                                        H.isNode(n) && a(n, t)
                                    }), (T = R.extend({}, $.defaults, E)).loop = parseInt(T.loop, 10);
                                    var M = 2 * T.loop - 1;
                                    if (T.loop)
                                        for (var N = 0, K; N < M; N++) K = {
                                            delay: T.delay,
                                            progress: T.progress
                                        }, N == M - 1 && (K.display = T.display, K.visibility = T.visibility, K.complete = T.complete), s(h, "reverse", K);
                                    return t()
                                }
                                q.promise && (B && E && !1 === E.promiseRejectEmpty ? q.resolver() : q.rejecter())
                            };
                            ($ = R.extend(s, $)).animate = s;
                            var q = i.requestAnimationFrame || h;
                            return $.State.isMobile || d.hidden === _ || ((n = function() {
                                d.hidden ? (q = function(e) {
                                    return setTimeout(function() {
                                        e(!0)
                                    }, 16)
                                }, l()) : q = i.requestAnimationFrame || h
                            })(), d.addEventListener("visibilitychange", n)), t.Velocity = $, t !== i && (t.fn.velocity = s, t.fn.velocity.defaults = $.defaults), R.each(["Down", "Up"], function(e, l) {
                                $.Redirects["slide" + l] = function(d, e, p, c, i, u) {
                                    var e = R.extend({}, e),
                                        t = e.begin,
                                        o = e.complete,
                                        r = {},
                                        s = {
                                            height: "",
                                            marginTop: "",
                                            marginBottom: "",
                                            paddingTop: "",
                                            paddingBottom: ""
                                        };
                                    e.display === _ && (e.display = "Down" === l ? "inline" === $.CSS.Values.getDisplayType(d) ? "inline-block" : "block" : "none"), e.begin = function() {
                                        for (var o in 0 === p && t && t.call(i, i), s) {
                                            var n;
                                            s.hasOwnProperty(o) && (r[o] = d.style[o], n = pe.getPropertyValue(d, o), s[o] = "Down" === l ? [n, 0] : [0, n])
                                        }
                                        r.overflow = d.style.overflow, d.style.overflow = "hidden"
                                    }, e.complete = function() {
                                        for (var e in r) r.hasOwnProperty(e) && (d.style[e] = r[e]);
                                        p === c - 1 && (o && o.call(i, i), u && u.resolver(i))
                                    }, $(d, s, e)
                                }
                            }), R.each(["In", "Out"], function(e, t) {
                                $.Redirects["fade" + t] = function(a, l, d, p, n, i) {
                                    var r = R.extend({}, l),
                                        o = r.complete,
                                        l = {
                                            opacity: "In" === t ? 1 : 0
                                        };
                                    0 !== d && (r.begin = null), r.complete = d === p - 1 ? function() {
                                        o && o.call(n, n), i && i.resolver(n)
                                    } : null, r.display === _ && (r.display = "In" === t ? "auto" : "none"), $(this, l, r)
                                }
                            }), $
                        }
                        jQuery.fn.velocity = jQuery.fn.animate
                    }(window.jQuery || window.Zepto || window, window, window ? window.document : void 0)
                })
            },
            598: (n, o, e) => {
                n.exports = e.g.Tether = e(519)
            },
            609: e => {
                "use strict";
                e.exports = jQuery
            }
        },
        o = {};
    s.amdO = {}, s.n = t => {
        var n = t && t.__esModule ? () => t.default : () => t;
        return s.d(n, {
            a: n
        }), n
    }, s.d = (n, o) => {
        for (var e in o) s.o(o, e) && !s.o(n, e) && Object.defineProperty(n, e, {
            enumerable: !0,
            get: o[e]
        })
    }, s.g = function() {
        if ("object" == typeof globalThis) return globalThis;
        try {
            return this || new Function("return this")()
        } catch (e) {
            if ("object" == typeof window) return window
        }
    }(), s.o = (t, n) => Object.prototype.hasOwnProperty.call(t, n), (() => {
        "use strict";

        function n(n, o) {
            var e = o.children().detach();
            o.empty().append(n.children().detach()), n.append(e)
        }

        function t() {
            y().responsive.mobile ? b()("*[id^='_desktop_']").each((r, o) => {
                var e = b()(`#${o.id.replace("_desktop_","_mobile_")}`);
                e.length && n(b()(o), e)
            }) : b()("*[id^='_mobile_']").each((r, o) => {
                var e = b()(`#${o.id.replace("_mobile_","_desktop_")}`);
                e.length && n(b()(o), e)
            }), y().emit("responsive update", {
                mobile: y().responsive.mobile
            })
        }

        function g() {
            b().each(b()(r), (t, n) => {
                b()(n).TouchSpin({
                    verticalbuttons: !0,
                    verticalupclass: "material-icons touchspin-up",
                    verticaldownclass: "material-icons touchspin-down",
                    buttondown_class: "btn btn-touchspin js-touchspin js-increase-product-quantity",
                    buttonup_class: "btn btn-touchspin js-touchspin js-decrease-product-quantity",
                    min: parseInt(b()(n).attr("min"), 10),
                    max: 1e6
                })
            }), b()(y().themeSelectors.touchspin).off("touchstart.touchspin"), v.switchErrorStat()
        }
        s(598), s(948), s(635), s(877), s(990);
        var e = prestashop,
            y = s.n(e),
            e = s(609),
            b = s.n(e);
        y().themeSelectors = {
            product: {
                tabs: ".tabs .nav-link",
                activeNavClass: "js-product-nav-active",
                activeTabClass: "js-product-tab-active",
                activeTabs: ".tabs .nav-link.active, .js-product-nav-active",
                imagesModal: ".js-product-images-modal",
                thumb: ".js-thumb",
                thumbContainer: ".thumb-container, .js-thumb-container",
                arrows: ".js-arrows",
                selected: ".selected, .js-thumb-selected",
                modalProductCover: ".js-modal-product-cover",
                cover: ".js-qv-product-cover"
            },
            listing: {
                searchFilterToggler: "#search_filter_toggler, .js-search-toggler",
                searchFiltersWrapper: "#search_filters_wrapper",
                searchFilterControls: "#search_filter_controls",
                searchFilters: "#search_filters",
                activeSearchFilters: "#js-active-search-filters",
                listTop: "#js-product-list-top",
                list: "#js-product-list",
                listBottom: "#js-product-list-bottom",
                listHeader: "#js-product-list-header",
                searchFiltersClearAll: ".js-search-filters-clear-all",
                searchLink: ".js-search-link"
            },
            order: {
                returnForm: "#order-return-form, .js-order-return-form"
            },
            arrowDown: ".arrow-down, .js-arrow-down",
            arrowUp: ".arrow-up, .js-arrow-up",
            clear: ".clear",
            fileInput: ".js-file-input",
            contentWrapper: "#content-wrapper, .js-content-wrapper",
            footer: "#footer, .js-footer",
            modalContent: ".js-modal-content",
            modal: "#modal, .js-checkout-modal",
            touchspin: ".js-touchspin",
            checkout: {
                termsLink: ".js-terms a",
                giftCheckbox: ".js-gift-checkbox",
                imagesLink: ".card-block .cart-summary-products p a, .js-show-details",
                carrierExtraContent: ".carrier-extra-content, .js-carrier-extra-content"
            }
        }, b()(document).ready(() => {
            y().emit("themeSelectorsInit")
        }), y().responsive = y().responsive || {}, y().responsive.current_width = window.innerWidth, y().responsive.min_width = 768, y().responsive.mobile = y().responsive.current_width < y().responsive.min_width, b()(window).on("resize", () => {
            var n = y().responsive.current_width,
                o = y().responsive.min_width,
                s = window.innerWidth,
                o = o <= n && s < o || n < o && o <= s;
            y().responsive.current_width = s, y().responsive.mobile = y().responsive.current_width < y().responsive.min_width, o && t()
        }), b()(document).ready(() => {
            y().responsive.mobile && t()
        }), b()(document).ready(() => {
            1 === b()("body#checkout").length && (b()(y().themeSelectors.checkout.termsLink).on("click", e => {
                e.preventDefault(), e = b()(e.target).attr("href"), e && (e += "?content_only=1", b().get(e, e => {
                    b()(y().themeSelectors.modal).find(y().themeSelectors.modalContent).html(b()(e).find(".page-cms").contents())
                }).fail(e => {
                    y().emit("handleError", {
                        eventType: "clickTerms",
                        resp: e
                    })
                })), b()(y().themeSelectors.modal).modal("show")
            }), b()(y().themeSelectors.checkout.giftCheckbox).on("click", () => {
                b()("#gift").collapse("toggle")
            }), b()(y().themeSelectors.checkout.imagesLink).on("click", function() {
                const e = b()(this).find("i.material-icons");
                "expand_more" === e.text() ? e.text("expand_less") : e.text("expand_more")
            })), y().on("updatedDeliveryForm", e => {
                void 0 !== e.deliveryOption && 0 !== e.deliveryOption.length && (b()(y().themeSelectors.checkout.carrierExtraContent).hide(), e.deliveryOption.next(y().themeSelectors.checkout.carrierExtraContent).slideDown())
            })
        }), b()(document).ready(function() {
            b()("body#order-detail") && b()(`${y().themeSelectors.order.returnForm} table thead input[type=checkbox]`).on("click", function() {
                const t = b()(this).prop("checked");
                b()(`${y().themeSelectors.order.returnForm} table tbody input[type=checkbox]`).each((o, n) => {
                    b()(n).prop("checked", t)
                })
            })
        }), s(5);
        class l {
            init() {
                b()(".js-product-miniature").each((t, n) => {
                    if (5 < b()(n).find(".color").length) {
                        let t = 0;
                        b()(n).find(".color").each((o, n) => {
                            4 < o && (b()(n).hide(), t += 1)
                        }), b()(n).find(".js-count").append(`+${t}`)
                    }
                })
            }
        }
        b()(document).ready(() => {
            const e = window.location.href;
            y().on("clickQuickView", e => {
                e = {
                    action: "quickview",
                    id_product: e.dataset.idProduct,
                    id_product_attribute: e.dataset.idProductAttribute
                }, b().post(y().urls.pages.product, e, null, "json").then(t => {
                    b()("body").append(t.quickview_html);
                    const n = b()(`#quickview-modal-${t.product.id}-${t.product.id_product_attribute}`);
                    n.modal("show"), o(n), n.on("hidden.bs.modal", () => {
                        n.remove()
                    }), Nov_Owlcarousel(), Thumnail_Product()
                }).fail(e => {
                    y().emit("handleError", {
                        eventType: "clickQuickView",
                        resp: e
                    })
                })
            });
            const o = t => {
                    const n = b()(y().themeSelectors.product.arrows),
                        e = t.find(".js-qv-product-images");
                    b()(y().themeSelectors.product.thumb).on("click", e => {
                        b()(y().themeSelectors.product.thumb).hasClass("selected") && b()(y().themeSelectors.product.thumb).removeClass("selected"), b()(e.currentTarget).addClass("selected"), b()(y().themeSelectors.product.cover).attr("src", b()(e.target).data("image-large-src"))
                    }), 4 >= e.find("li").length ? n.hide() : n.on("click", t => {
                        b()(t.target).hasClass("arrow-up") && 0 > b()(".js-qv-product-images").position().top ? (s("up"), b()(y().themeSelectors.arrowDown).css("opacity", "1")) : b()(t.target).hasClass("arrow-down") && e.position().top + e.height() > b()(".js-qv-mask").height() && (s("down"), b()(y().themeSelectors.arrowUp).css("opacity", "1"))
                    }), t.find(y().selectors.quantityWanted).TouchSpin({
                        verticalbuttons: !0,
                        verticalupclass: "material-icons touchspin-up",
                        verticaldownclass: "material-icons touchspin-down",
                        buttondown_class: "btn btn-touchspin js-touchspin",
                        buttonup_class: "btn btn-touchspin js-touchspin",
                        min: 1,
                        max: 1e6
                    }), b()(y().themeSelectors.touchspin).off("touchstart.touchspin")
                },
                s = r => {
                    const o = b()(".js-qv-product-images");
                    var e = b()(".js-qv-product-images li img").height() + 20,
                        t = o.position().top;
                    o.velocity({
                        translateY: "up" === r ? t + e : t - e
                    }, () => {
                        0 <= o.position().top ? b()(".arrow-up").css("opacity", ".2") : o.position().top + o.height() <= b()(".js-qv-mask").height() && b()(".arrow-down").css("opacity", ".2")
                    })
                };
            b()("body").on("click", y().themeSelectors.listing.searchFilterToggler, () => {
                b()(y().themeSelectors.listing.searchFiltersWrapper).removeClass("hidden-sm-down"), b()(y().themeSelectors.contentWrapper).addClass("hidden-sm-down"), b()(y().themeSelectors.footer).addClass("hidden-sm-down")
            }), b()(`${y().themeSelectors.listing.searchFilterControls} ${y().themeSelectors.clear}`).on("click", () => {
                b()(y().themeSelectors.listing.searchFiltersWrapper).addClass("hidden-sm-down"), b()(y().themeSelectors.contentWrapper).removeClass("hidden-sm-down"), b()(y().themeSelectors.footer).removeClass("hidden-sm-down")
            }), b()(`${y().themeSelectors.listing.searchFilterControls} .ok`).on("click", () => {
                b()(y().themeSelectors.listing.searchFiltersWrapper).addClass("hidden-sm-down"), b()(y().themeSelectors.contentWrapper).removeClass("hidden-sm-down"), b()(y().themeSelectors.footer).removeClass("hidden-sm-down")
            });
            const r = function(e) {
                if (void 0 !== e.target.dataset.searchUrl) return e.target.dataset.searchUrl;
                if (void 0 === b()(e.target).parent()[0].dataset.searchUrl) throw new Error("Can not parse search URL");
                return b()(e.target).parent()[0].dataset.searchUrl
            };
            b()("body").on("change", `${y().themeSelectors.listing.searchFilters} input[data-search-url]`, e => {
                y().emit("updateFacets", r(e))
            }), b()("body").on("click", y().themeSelectors.listing.searchFiltersClearAll, e => {
                y().emit("updateFacets", r(e))
            }), b()("body").on("click", y().themeSelectors.listing.searchLink, e => {
                e.preventDefault(), y().emit("updateFacets", b()(e.target).closest("a").get(0).href)
            }), window.addEventListener("popstate", n => {
                var {
                    state: n
                } = n;
                window.location.href = n && n.current_url ? n.current_url : e
            }), b()("body").on("change", `${y().themeSelectors.listing.searchFilters} select`, t => {
                const n = b()(t.target).closest("form");
                y().emit("updateFacets", `?${n.serialize()}`)
            }), y().on("updateProductList", e => {
                ! function(t) {
                    b()(y().themeSelectors.listing.searchFilters).replaceWith(t.rendered_facets), b()(y().themeSelectors.listing.activeSearchFilters).replaceWith(t.rendered_active_filters), b()(y().themeSelectors.listing.listTop).replaceWith(t.rendered_products_top), b()(y().themeSelectors.listing.list).replaceWith(t.rendered_products), b()(y().themeSelectors.listing.listBottom).replaceWith(t.rendered_products_bottom), t.rendered_products_header && b()(y().themeSelectors.listing.listHeader).replaceWith(t.rendered_products_header);
                    const n = new l;
                    n.init()
                }(e), window.scrollTo(0, 0)
            })
        });
        class c {
            init() {
                const e = b()(".js-modal-arrows"),
                    n = b()(".js-modal-product-images");
                b()("body").on("click", ".js-modal-thumb", e => {
                    b()(".js-modal-thumb").hasClass("selected") && b()(".js-modal-thumb").removeClass("selected"), b()(e.currentTarget).addClass("selected"), b()(".js-modal-product-cover").attr("src", b()(e.target).data("image-large-src")), b()(".js-modal-product-cover").attr("title", b()(e.target).attr("title")), b()(".js-modal-product-cover").attr("alt", b()(e.target).attr("alt"))
                }).on("click", "aside#thumbnails", e => {
                    "thumbnails" === e.target.id && b()("#product-modal").modal("hide")
                }), 5 >= b()(".js-modal-product-images li").length ? e.css("opacity", ".2") : e.on("click", e => {
                    b()(e.target).hasClass("arrow-up") && 0 > n.position().top ? (this.move("up"), b()(".js-modal-arrow-down").css("opacity", "1")) : b()(e.target).hasClass("arrow-down") && n.position().top + n.height() > b()(".js-modal-mask").height() && (this.move("down"), b()(".js-modal-arrow-up").css("opacity", "1"))
                })
            }
            move(r) {
                const o = b()(".js-modal-product-images");
                var e = b()(".js-modal-product-images li img").height() + 10,
                    t = o.position().top;
                o.velocity({
                    translateY: "up" === r ? t + e : t - e
                }, () => {
                    0 <= o.position().top ? b()(".js-modal-arrow-up").css("opacity", ".2") : o.position().top + o.height() <= b()(".js-modal-mask").height() && b()(".js-modal-arrow-down").css("opacity", ".2")
                })
            }
        }
        b()(document).ready(() => {
            function i() {
                const n = b()(y().themeSelectors.product.cover);
                let r = b()(y().themeSelectors.product.selected);
                const s = (r, o) => {
                    const e = o.find(y().themeSelectors.product.thumb);
                    b()(y().themeSelectors.product.modalProductCover).attr("src", e.data("image-large-src")), r.removeClass("selected"), e.addClass("selected"), n.prop("src", e.data("image-medium-src"))
                };
                b()(y().themeSelectors.product.thumb).on("click", e => {
                    r = b()(y().themeSelectors.product.selected), s(r, b()(e.target).closest(y().themeSelectors.product.thumbContainer))
                }), n.swipe({
                    swipe: (n, o) => {
                        r = b()(y().themeSelectors.product.selected);
                        const e = r.closest(y().themeSelectors.product.thumbContainer);
                        "right" === o ? 0 < e.prev().length ? s(r, e.prev()) : 0 < e.next().length && s(r, e.next()) : "left" == o && (0 < e.next().length ? s(r, e.next()) : 0 < e.prev().length && s(r, e.prev()))
                    }
                })
            }

            function r() {
                2 < b()("#main .js-qv-product-images li").length ? (b()("#main .js-qv-mask").addClass("scroll"), b()(".scroll-box-arrows").addClass("scroll"), b()("#main .js-qv-mask").scrollbox({
                    direction: "h",
                    distance: 113,
                    autoPlay: !1
                }), b()(".scroll-box-arrows .left").click(() => {
                    b()("#main .js-qv-mask").trigger("backward")
                }), b()(".scroll-box-arrows .right").click(() => {
                    b()("#main .js-qv-mask").trigger("forward")
                })) : (b()("#main .js-qv-mask").removeClass("scroll"), b()(".scroll-box-arrows").removeClass("scroll"))
            }

            function o() {
                b()(y().themeSelectors.fileInput).on("change", e => {
                    let t;
                    (e = b()(e.currentTarget)[0]) && (t = e.files[0]) && b()(e).prev().text(t.name)
                })
            }! function() {
                const e = b()(y().selectors.quantityWanted);
                e.TouchSpin({
                    verticalbuttons: !0,
                    verticalupclass: "material-icons touchspin-up",
                    verticaldownclass: "material-icons touchspin-down",
                    buttondown_class: "btn btn-touchspin js-touchspin",
                    buttonup_class: "btn btn-touchspin js-touchspin",
                    min: parseInt(e.attr("min"), 10),
                    max: 1e6
                }), b()(y().themeSelectors.touchspin).off("touchstart.touchspin"), e.focusout(() => {
                    ("" === e.val() || e.val() < e.attr("min")) && (e.val(e.attr("min")), e.trigger("change"))
                }), b()("body").on("change keyup", y().selectors.quantityWanted, n => {
                    "" !== e.val() && (b()(n.currentTarget).trigger("touchspin.stopspin"), y().emit("updateProduct", {
                        eventType: "updatedProductQuantity",
                        event: n
                    }))
                })
            }(), o(), i(), r(),
                function() {
                    const e = b()(y().themeSelectors.product.tabs);
                    e.on("show.bs.tab", t => {
                        const n = b()(t.target);
                        n.addClass(y().themeSelectors.product.activeNavClass), b()(n.attr("href")).addClass(y().themeSelectors.product.activeTabClass)
                    }), e.on("hide.bs.tab", t => {
                        const n = b()(t.target);
                        n.removeClass(y().themeSelectors.product.activeNavClass), b()(n.attr("href")).removeClass(y().themeSelectors.product.activeTabClass)
                    })
                }(), y().on("updatedProduct", s => {
                    if (o(), i(), s && s.product_minimal_quantity) {
                        var a = parseInt(s.product_minimal_quantity, 10),
                            e = y().selectors.quantityWanted;
                        const t = b()(e);
                        t.trigger("touchspin.updatesettings", {
                            min: a
                        })
                    }
                    Nov_Owlcarousel(), Thumnail_Product(), r(), b()(b()(y().themeSelectors.product.activeTabs).attr("href")).addClass("active").removeClass("fade"), b()(y().themeSelectors.product.imagesModal).replaceWith(s.product_images_modal);
                    const t = new c;
                    t.init()
                })
        }), y().cart = y().cart || {}, y().cart.active_inputs = null;
        const r = "input[name=\"product-quantity-spin\"]";
        let o = !1,
            i = !1,
            u = "";
        b()(document).ready(() => {
            function t(n, o) {
                if ("on.startupspin" !== (e = o) && "on.startdownspin" !== e) return {
                    url: n.attr("href"),
                    type: function(n) {
                        var o = n.split("-");
                        let e = "",
                            r, i;
                        for (r = 0; r < o.length; r += 1) i = o[r], 0 !== r && (i = i.substring(0, 1).toUpperCase() + i.substring(1)), e += i;
                        return e
                    }(n.data("link-action"))
                };
                var e;
                const r = function(t) {
                    const n = t.parents(".bootstrap-touchspin").find(l);
                    return n.is(":focus") ? null : n
                }(n);
                if (!r) return !1;
                let s = {};
                return s = "on.startupspin" === o ? {
                    url: r.data("up-url"),
                    type: "increaseProductQuantity"
                } : {
                    url: r.data("down-url"),
                    type: "decreaseProductQuantity"
                }, s
            }

            function a(e) {
                const o = b()(e.currentTarget);
                var r = o.data("update-url"),
                    i = o.attr("value"),
                    e = o.val(),
                    a;
                e != parseInt(e, 10) || 0 > e || isNaN(e) ? o.val(i) : 0 != (i = e - i) && (o.attr("value", e), r = r, i = i, i = {
                    ajax: "1",
                    qty: Math.abs(i),
                    action: "update",
                    op: 0 < i ? "up" : "down"
                }, a = o, u(), b().ajax({
                    url: r,
                    method: "POST",
                    data: i,
                    dataType: "json",
                    beforeSend(e) {
                        n.push(e)
                    }
                }).then(t => {
                    v.checkUpdateOpertation(t), a.val(t.quantity);
                    let n;
                    n = a && a.dataset ? a.dataset : t, y().emit("updateCart", {
                        reason: n,
                        resp: t
                    })
                }).fail(e => {
                    y().emit("handleError", {
                        eventType: "updateProductQuantityInCart",
                        resp: e
                    })
                }))
            }
            const l = ".js-cart-line-product-quantity",
                n = [];
            y().on("updateCart", () => {
                b()(".quickview").modal("hide")
            }), y().on("updatedCart", () => {
                g()
            }), g();
            const o = b()("body"),
                u = () => {
                    for (let e; 0 < n.length;) e = n.pop(), e.abort()
                };
            var s = e => {
                e.preventDefault();
                const a = b()(e.currentTarget),
                    {
                        dataset: s
                    } = e.currentTarget,
                    o = t(a, e.namespace);
                o && (u(), b().ajax({
                    url: o.url,
                    method: "POST",
                    data: {
                        ajax: "1",
                        action: "update"
                    },
                    dataType: "json",
                    beforeSend(e) {
                        n.push(e)
                    }
                }).then(n => {
                    v.checkUpdateOpertation(n);
                    const o = (e = a, b()(e.parents(".bootstrap-touchspin").find("input")));
                    var e;
                    o.val(n.quantity), y().emit("updateCart", {
                        reason: s,
                        resp: n
                    })
                }).fail(e => {
                    y().emit("handleError", {
                        eventType: "updateProductInCart",
                        resp: e,
                        cartAction: o.type
                    })
                }))
            };
            o.on("click", "[data-link-action=\"delete-from-cart\"], [data-link-action=\"remove-voucher\"]", s), o.on("touchspin.on.startdownspin", r, s), o.on("touchspin.on.startupspin", r, s), o.on("focusout keyup", ".js-cart-line-product-quantity", e => ("keyup" === e.type ? 13 === e.keyCode && a(e) : a(e), !1)), o.on("hidden.bs.collapse", "#promo-code", () => {
                b()(".display-promo").show(400)
            }), o.on("click", ".promo-code-button", e => {
                e.preventDefault(), b()("#promo-code").collapse("toggle")
            }), o.on("click", ".display-promo", e => {
                b()(e.currentTarget).hide(400)
            }), o.on("click", ".js-discount .code", n => {
                n.stopPropagation();
                const o = b()(n.currentTarget),
                    e = b()("[name=discount_name]");
                return e.val(o.text()), b()("#promo-code").collapse("show"), b()(".display-promo").hide(400), !1
            })
        });
        const v = {
            switchErrorStat: () => {
                const t = b()(".checkout a");
                var n;
                (b()("#notifications article.alert-danger").length || "" !== u && !o) && t.addClass("disabled"), "" === u ? !o && i && (o = !1, i = !1, b()("#notifications .container").html(""), t.removeClass("disabled")) : (n = ` <article class="alert alert-danger" role="alert" data-alert="danger"><ul><li>${u}</li></ul></article>`, b()("#notifications .container").html(n), u = "", i = !1, o && t.removeClass("disabled"))
            },
            checkUpdateOpertation: t => {
                o = t.hasOwnProperty("hasError");
                const n = t.errors || "";
                u = n instanceof Array ? n.join(" ") : n, i = !0
            }
        };
        var e = s(590),
            _ = s.n(e);
        class h {
            constructor(e) {
                this.el = e
            }
            init() {
                this.el.on("show.bs.dropdown", (t, n) => {
                    (n ? b()(`#${n}`) : b()(t.target)).find(".dropdown-menu").first().stop(!0, !0).slideDown()
                }), this.el.on("hide.bs.dropdown", (t, n) => {
                    (n ? b()(`#${n}`) : b()(t.target)).find(".dropdown-menu").first().stop(!0, !0).slideUp()
                }), this.el.find("select.link").each((t, n) => {
                    b()(n).on("change", function() {
                        window.location = b()(this).val()
                    })
                })
            }
        }
        class S {
            init() {
                this.parentFocus(), this.togglePasswordVisibility()
            }
            parentFocus() {
                b()(".js-child-focus").focus(function() {
                    b()(this).closest(".js-parent-focus").addClass("focus")
                }), b()(".js-child-focus").focusout(function() {
                    b()(this).closest(".js-parent-focus").removeClass("focus")
                })
            }
            togglePasswordVisibility() {
                b()("button[data-action=\"show-password\"]").on("click", function() {
                    const e = b()(this).closest(".input-group").children("input.js-visible-password");
                    "password" === e.attr("type") ? (e.attr("type", "text"), b()(this).html(b()(this).data("textHide"))) : (e.attr("type", "password"), b()(this).html(b()(this).data("textShow")))
                })
            }
        }
        class p extends h {
            init() {
                let n;
                const e = this;
                this.el.find("li").hover(t => {
                    if (!this.el.parent().hasClass("mobile")) {
                        var o = b()(t.currentTarget).attr("class");
                        if (n !== o) {
                            const o = Array.prototype.slice.call(t.currentTarget.classList).map(e => "string" == typeof e && `.${e}`);
                            n = o.join(""), n && 0 === b()(t.target).data("depth") && b()(`${n} .js-sub-menu`).css({
                                top: b()(`${n}`).height() + b()(`${n}`).position().top
                            })
                        }
                    }
                }), b()("#menu-icon").on("click", () => {
                    b()("#mobile_top_menu_wrapper").toggle(), e.toggleMobileMenu()
                }), this.el.on("click", e => {
                    this.el.parent().hasClass("mobile") || e.stopPropagation()
                }), y().on("responsive update", () => {
                    b()(".js-sub-menu").removeAttr("style"), e.toggleMobileMenu()
                }), super.init()
            }
            toggleMobileMenu() {
                b()("#header").toggleClass("is-open"), b()("#mobile_top_menu_wrapper").is(":visible") ? b()("#notifications, #wrapper, #footer").hide() : b()("#notifications, #wrapper, #footer").show()
            }
        }
        for (const t in s(105), s(285), y().blockcart = y().blockcart || {}, y().blockcart.showModal = n => {
                function o() {
                    return b()("#blockcart-modal")
                }
                let e = o();
                e.length && e.remove(), b()("body").append(n), e = o(), e.modal("show").on("hidden.bs.modal", e => {
                    y().emit("updateProduct", {
                        reason: e.currentTarget.dataset,
                        event: e
                    })
                })
            }, _().prototype) y()[t] = _().prototype[t];
        b()(document).ready(() => {
            var s = b()(".js-dropdown");
            const a = new S;
            var e = b()(".js-top-menu ul[data-depth=\"0\"]");
            const t = new h(s),
                n = new p(e),
                i = new l,
                r = new c;
            t.init(), a.init(), n.init(), i.init(), r.init(), b()(".carousel[data-touch=\"true\"]").swipe({
                swipe(t, n) {
                    "left" === n && b()(this).carousel("next"), "right" === n && b()(this).carousel("prev")
                },
                allowPageScroll: "vertical"
            })
        })
    })()
})();
