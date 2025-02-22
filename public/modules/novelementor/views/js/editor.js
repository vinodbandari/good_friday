(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var HandleAddDuplicateBehavior;

HandleAddDuplicateBehavior = Marionette.Behavior.extend( {

	onChildviewClickNew: function( childView ) {
		var currentIndex = childView.$el.index() + 1;

		this.addChild( { at: currentIndex } );
	},

	onRequestNew: function() {
		this.addChild();
	},

	addChild: function( options ) {
		if ( this.view.isCollectionFilled() ) {
			return;
		}

		options = options || {};

		var newItem = {
			id: elementor.helpers.getUniqueID(),
			elType: this.view.getChildType()[0],
			settings: {},
			elements: []
		};

		this.view.addChildModel( newItem, options );
	}
} );

module.exports = HandleAddDuplicateBehavior;

},{}],2:[function(require,module,exports){
var HandleElementsRelation;

HandleElementsRelation = Marionette.Behavior.extend( {

	onRequestAdd: function( itemData, options ) {
		this._addChildElement( itemData, options );
	},

	/**
	 *
	 * @param {Object} itemData
	 * @param {Object} options
	 * @private
	 */
	_addChildElement: function( itemData, options ) {
		options = options || {};

		var myChildType = this.view.getChildType();

		if ( -1 === myChildType.indexOf( itemData.elType ) ) {
			delete options.at;

			this.view.children.last().triggerMethod( 'request:add', itemData, options );

			return;
		}

		var newModel = this.view.addChildModel( itemData, options ),
			newView = this.view.children.findByModel( newModel );

		if ( 'section' === newView.getElementType() && newView.isInner() ) {
			newView.addEmptyColumn();
		}

		newView.edit();
	}
} );

module.exports = HandleElementsRelation;

},{}],3:[function(require,module,exports){
var HandleDuplicateBehavior;

HandleDuplicateBehavior = Marionette.Behavior.extend( {

	onChildviewClickDuplicate: function( childView ) {
		if ( this.view.isCollectionFilled() ) {
			return;
		}

		var currentIndex = this.view.collection.indexOf( childView.model ),
			newModel = childView.model.clone();

		this.view.addChildModel( newModel, { at: currentIndex } );
	}
} );

module.exports = HandleDuplicateBehavior;

},{}],4:[function(require,module,exports){
var InnerTabsBehavior;

InnerTabsBehavior = Marionette.Behavior.extend( {

	onRender: function() {
		this.handleInnerTabs( this.view );
	},

	handleInnerTabs: function( parent ) {
		var closedClass = 'elementor-tab-close',
			activeClass = 'elementor-tab-active',
			tabsWrappers = parent.children.filter( function( view ) {
				return ( view.model.get( 'is_tabs_wrapper' ) );
			} );

		_.each( tabsWrappers, function( view ) {
			view.$el.addClass( 'type-tabs' );

			var tabsId = view.model.get( 'name' ),
				tabs = parent.children.filter( function( childView ) {
					return ( 'tab' === childView.model.get( 'type' ) && childView.model.get( 'tabs_wrapper' ) === tabsId );
				} );

			_.each( tabs, function( childView, index ) {
				view._addChildView( childView );

				var tabId =  childView.model.get( 'name' ),
					controlsUnderTab = parent.children.filter( function( view ) {
						return ( tabId === view.model.get( 'inner_tab' ) );
					} );

				if ( 0 === index ) {
					childView.$el.addClass( activeClass );
				} else {
					_.each( controlsUnderTab, function( view ) {
						view.$el.addClass( closedClass );
					} );
				}
			} );
		} );
	},

	onChildviewControlTabClicked: function( childView ) {
		var closedClass = 'elementor-tab-close',
			activeClass = 'elementor-tab-active',
			tabClicked = childView.model.get( 'name' ),

			childrenUnderTab = this.view.children.filter( function( view ) {
				return ( 'tab' !== view.model.get( 'type' ) && childView.model.get( 'tabs_wrapper' ) === view.model.get( 'tabs_wrapper' ) );
			} ),
			siblingTabs = this.view.children.filter( function( view ) {
				return ( 'tab' === view.model.get( 'type' ) && childView.model.get( 'tabs_wrapper' ) === view.model.get( 'tabs_wrapper' ) );
			} );

		_.each( siblingTabs, function( view ) {
			view.$el.removeClass( activeClass );
		} );

		childView.$el.addClass( activeClass );

		_.each( childrenUnderTab, function( view ) {
			if ( view.model.get( 'inner_tab' ) === tabClicked ) {
				view.$el.removeClass( closedClass );
			} else {
				view.$el.addClass( closedClass );
			}
		} );

		elementor.channels.data.trigger( 'scrollbar:update' );
	}
} );

module.exports = InnerTabsBehavior;

},{}],5:[function(require,module,exports){
var ResizableBehavior;

ResizableBehavior = Marionette.Behavior.extend( {
	defaults: {
		handles: elementor.config.is_rtl ? 'w' : 'e'
	},

	ui: {
		columnTitle: '.column-title'
	},

	events: {
		resizestart: 'onResizeStart',
		resizestop: 'onResizeStop',
		resize: 'onResize'
	},

	initialize: function() {
		Marionette.Behavior.prototype.initialize.apply( this, arguments );

		this.listenTo( elementor.channels.dataEditMode, 'switch', this.onEditModeSwitched );
	},

	active: function() {
		var options = _.clone( this.options );

		delete options.behaviorClass;

		var $childViewContainer = this.getChildViewContainer(),
			defaultResizableOptions = {},
			resizableOptions = _.extend( defaultResizableOptions, options );

		$childViewContainer.resizable( resizableOptions );
	},

	deactivate: function() {
		if ( this.getChildViewContainer().resizable( 'instance' ) ) {
			this.getChildViewContainer().resizable( 'destroy' );
		}
	},

	onEditModeSwitched: function() {
		var activeMode = elementor.channels.dataEditMode.request( 'activeMode' );

		if ( 'preview' !== activeMode ) {
			this.active();
		} else {
			this.deactivate();
		}
	},

	onRender: function() {
		// Call this method from other thread (non-block UI)
		_.defer( _.bind( this.onEditModeSwitched, this ) );
	},

	onDestroy: function() {
		this.deactivate();
	},

	onResizeStart: function( event ) {
		event.stopPropagation();

		this.view.triggerMethod( 'request:resize:start' );
	},

	onResizeStop: function( event ) {
		event.stopPropagation();

		this.view.triggerMethod( 'request:resize:stop' );
	},

	onResize: function( event, ui ) {
		event.stopPropagation();

		this.view.triggerMethod( 'request:resize', ui );
	},

	getChildViewContainer: function() {
		return this.$el;
	}
} );

module.exports = ResizableBehavior;

},{}],6:[function(require,module,exports){
var SortableBehavior;

SortableBehavior = Marionette.Behavior.extend( {
	defaults: {
		elChildType: 'widget'
	},

	events: {
		'sortstart': 'onSortStart',
		'sortreceive': 'onSortReceive',
		'sortupdate': 'onSortUpdate',
		'sortstop': 'onSortStop',
		'sortover': 'onSortOver',
		'sortout': 'onSortOut'
	},

	initialize: function() {
		this.listenTo( elementor.channels.dataEditMode, 'switch', this.onEditModeSwitched );
		this.listenTo( elementor.channels.deviceMode, 'change', this.onDeviceModeChange );
	},

	onEditModeSwitched: function() {
		var activeMode = elementor.channels.dataEditMode.request( 'activeMode' );

		if ( 'preview' !== activeMode ) {
			this.active();
		} else {
			this.deactivate();
		}
	},

	onDeviceModeChange: function() {
		var deviceMode = elementor.channels.deviceMode.request( 'currentMode' );

		if ( 'desktop' === deviceMode ) {
			this.active();
		} else {
			this.deactivate();
		}
	},

	onRender: function() {
		_.defer( _.bind( this.onEditModeSwitched, this ) );
	},

	onDestroy: function() {
		this.deactivate();
	},

	active: function() {
		if ( this.getChildViewContainer().sortable( 'instance' ) ) {
			return;
		}

		var $childViewContainer = this.getChildViewContainer(),
			defaultSortableOptions = {
				connectWith: $childViewContainer.selector,
				cursor: 'move',
				distance: 5,
				placeholder: 'elementor-sortable-placeholder',
				cursorAt: {
					top: 20,
					left: 25
				},
				helper: _.bind( this._getSortableHelper, this )
			},
			sortableOptions = _.extend( defaultSortableOptions, this.view.getSortableOptions() );

		$childViewContainer.sortable( sortableOptions );
	},

	_getSortableHelper: function( event, $item ) {
		var model = this.view.collection.get( {
			cid: $item.data( 'model-cid' )
		} );

		return '<div style="height: 84px; width: 125px;" class="elementor-sortable-helper elementor-sortable-helper-' + model.get( 'elType' ) + '"><div class="icon"><i class="eicon-' + model.getIcon() + '"></i></div><div class="elementor-element-title-wrapper"><div class="title">' + model.getTitle() + '</div></div></div>';
	},

	deactivate: function() {
		if ( this.getChildViewContainer().sortable( 'instance' ) ) {
			this.getChildViewContainer().sortable( 'destroy' );
		}
	},

	onSortStart: function( event, ui ) {
		event.stopPropagation();

		var model = this.view.collection.get( {
			cid: ui.item.data( 'model-cid' )
		} );

		if ( 'column' === this.options.elChildType ) {
			// the following code is just for touch
			ui.placeholder.addClass( 'elementor-column' );

			var uiData = ui.item.data( 'sortableItem' ),
				uiItems = uiData.items,
				itemHeight = 0;

			uiItems.forEach( function( item ) {
				if ( item.item[0] === ui.item[0] ) {
					itemHeight = item.height;
					return false;
				}
			} );

			ui.placeholder.height( itemHeight );

			// ui.placeholder.addClass( 'elementor-column elementor-col-' + model.getSetting( 'size' ) );
		}

		elementor.channels.data.trigger( model.get( 'elType' ) + ':drag:start' );

		elementor.channels.data.reply( 'cache:' + model.cid, model );
	},

	onSortOver: function( event, ui ) {
		event.stopPropagation();

		var model = elementor.channels.data.request( 'cache:' + ui.item.data( 'model-cid' ) );

		Backbone.$( event.target )
			.addClass( 'elementor-draggable-over' )
			.attr( {
				'data-dragged-element': model.get( 'elType' ),
				'data-dragged-is-inner': model.get( 'isInner' )
			} );

		this.$el.addClass( 'elementor-dragging-on-child' );
	},

	onSortOut: function( event ) {
		event.stopPropagation();

		Backbone.$( event.target )
			.removeClass( 'elementor-draggable-over' )
			.removeAttr( 'data-dragged-element data-dragged-is-inner' );

		this.$el.removeClass( 'elementor-dragging-on-child' );
	},

	onSortReceive: function( event, ui ) {
		event.stopPropagation();

		if ( this.view.isCollectionFilled() ) {
			Backbone.$( ui.sender ).sortable( 'cancel' );
			return;
		}

		var model = elementor.channels.data.request( 'cache:' + ui.item.data( 'model-cid' ) ),
			draggedElType = model.get( 'elType' ),
			draggedIsInnerSection = 'section' === draggedElType && model.get( 'isInner' ),
			targetIsInnerColumn = 'column' === this.view.getElementType() && this.view.isInner();

		if ( draggedIsInnerSection && targetIsInnerColumn ) {
			Backbone.$( ui.sender ).sortable( 'cancel' );
			return;
		}

		var newIndex = ui.item.parent().children().index( ui.item ),
			newModel = new this.view.collection.model( model.toJSON( { copyHtmlCache: true } ) );

		this.view.addChildModel( newModel, { at: newIndex } );

		elementor.channels.data.trigger( draggedElType + ':drag:end' );

		model.destroy();
	},

	onSortUpdate: function( event, ui ) {
		event.stopPropagation();

		var model = this.view.collection.get( ui.item.attr( 'data-model-cid' ) );
		if ( model ) {
			elementor.channels.data.trigger( model.get( 'elType' ) + ':drag:end' );
		}
	},

	onSortStop: function( event, ui ) {
		event.stopPropagation();

		var $childElement = ui.item,
			collection = this.view.collection,
			model = collection.get( $childElement.attr( 'data-model-cid' ) ),
			newIndex = $childElement.parent().children().index( $childElement );

		if ( this.getChildViewContainer()[0] === ui.item.parent()[0] ) {
			if ( null === ui.sender && model ) {
				var oldIndex = collection.indexOf( model );

				if ( oldIndex !== newIndex ) {
					collection.remove( model );
					this.view.addChildModel( model, { at: newIndex } );

					elementor.setFlagEditorChange( true );
				}

				elementor.channels.data.trigger( model.get( 'elType' ) + ':drag:end' );
			}
		}
	},

	onAddChild: function( view ) {
		view.$el.attr( 'data-model-cid', view.model.cid );
	},

	getChildViewContainer: function() {
		if ( 'function' === typeof this.view.getChildViewContainer ) {
			// CompositeView
			return this.view.getChildViewContainer( this.view );
		} else {
			// CollectionView
			return this.$el;
		}
	}
} );

module.exports = SortableBehavior;

},{}],7:[function(require,module,exports){
var TemplateLibraryTemplateModel = require( 'elementor-templates/models/template' ),
	TemplateLibraryCollection;

TemplateLibraryCollection = Backbone.Collection.extend( {
	model: TemplateLibraryTemplateModel
} );

module.exports = TemplateLibraryCollection;

},{"elementor-templates/models/template":9}],8:[function(require,module,exports){
var TemplateLibraryLayoutView = require( 'elementor-templates/views/layout' ),
	TemplateLibraryCollection = require( 'elementor-templates/collections/templates' ),
	TemplateLibraryManager;

TemplateLibraryManager = function() {
	var self = this,
		modal,
		deleteDialog,
		errorDialog,
		layout,
		templatesCollection;

	var initLayout = function() {
		layout = new TemplateLibraryLayoutView();
	};

	this.deleteTemplate = function( templateModel ) {
		var dialog = self.getDeleteDialog();

		dialog.onConfirm = function() {
			elementor.ajax.send( 'deleteTemplate', {
				data: {
					source: templateModel.get( 'source' ),
					template_id: templateModel.get( 'template_id' )
				},
				success: function() {
					templatesCollection.remove( templateModel, { silent: true } );

					self.showTemplates();
				}
			} );
		};

		dialog.show();
	};

	this.importTemplate = function( templateModel ) {
		layout.showLoadingView();

		elementor.ajax.send( 'getTemplateContent', {
			data: {
				source: templateModel.get( 'source' ),
				edit_mode: true,
				template_id: templateModel.get( 'template_id' )
			},
			success: function( data ) {
				self.getModal().hide();

				elementor.getRegion( 'sections' ).currentView.addChildModel( data );
			},
			error: function( data ) {
				self.showErrorDialog( data );
			}
		} );
	};

	this.getDeleteDialog = function() {
		if ( ! deleteDialog ) {
			deleteDialog = elementor.dialogsManager.createWidget( 'confirm', {
				id: 'elementor-template-library-delete-dialog',
				headerMessage: elementor.translate( 'delete_template' ),
				message: elementor.translate( 'delete_template_confirm' ),
				strings: {
					confirm: elementor.translate( 'delete' )
				}
			} );
		}

		return deleteDialog;
	};

	this.getErrorDialog = function() {
		if ( ! errorDialog ) {
			errorDialog = elementor.dialogsManager.createWidget( 'alert', {
				id: 'elementor-template-library-error-dialog',
				headerMessage: elementor.translate( 'an_error_occurred' )
			} );
		}

		return errorDialog;
	};

	this.getModal = function() {
		if ( ! modal ) {
			modal = elementor.dialogsManager.createWidget( 'elementor-modal', {
				id: 'elementor-template-library-modal',
				closeButton: false
			} );
		}

		return modal;
	};

	this.getLayout = function() {
		return layout;
	};

	this.getTemplatesCollection = function() {
		return templatesCollection;
	};

	this.requestRemoteTemplates = function( callback, forceUpdate ) {
		if ( templatesCollection && ! forceUpdate ) {
			if ( callback ) {
				callback();
			}

			return;
		}

		elementor.ajax.send( 'getTemplates', {
			success: function( data ) {
				templatesCollection = new TemplateLibraryCollection( data );

				if ( callback ) {
					callback();
				}
			}
		} );
	};

	this.startModal = function( onModalReady ) {
		self.getModal().show();

		self.setTemplatesSource( 'remote' );

		if ( ! layout ) {
			initLayout();
		}

		layout.showLoadingView();

		self.requestRemoteTemplates( function() {
			if ( onModalReady ) {
				onModalReady();
			}
		} );
	};

	this.setTemplatesSource = function( source, trigger ) {
		var channel = elementor.channels.templates;

		channel.reply( 'filter:source', source );

		if ( trigger ) {
			channel.trigger( 'filter:change' );
		}
	};

	this.showTemplates = function() {
		layout.showTemplatesView( templatesCollection );
	};

	this.showErrorDialog = function( errorMessage ) {
		self.getErrorDialog()
			.setMessage( elementor.translate( 'templates_request_error' ) + '<div id="elementor-template-library-error-info">' + errorMessage + '</div>' )
			.show();
	};
};

module.exports = new TemplateLibraryManager();

},{"elementor-templates/collections/templates":7,"elementor-templates/views/layout":10}],9:[function(require,module,exports){
var TemplateLibraryTemplateModel;

TemplateLibraryTemplateModel = Backbone.Model.extend( {
	defaults: {
		template_id: 0,
		name: '',
		title: '',
		source: '',
		type: '',
		author: '',
		thumbnail: '',
		url: '',
		export_link: '',
		categories: [],
		keywords: []
	}
} );

module.exports = TemplateLibraryTemplateModel;

},{}],10:[function(require,module,exports){
var TemplateLibraryHeaderView = require( 'elementor-templates/views/parts/header' ),
	TemplateLibraryHeaderLogoView = require( 'elementor-templates/views/parts/header-parts/logo' ),
	TemplateLibraryHeaderSaveView = require( 'elementor-templates/views/parts/header-parts/save' ),
	TemplateLibraryHeaderImportView = require( 'elementor-templates/views/parts/header-parts/import' ),
	TemplateLibraryHeaderMenuView = require( 'elementor-templates/views/parts/header-parts/menu' ),
	TemplateLibraryHeaderPreviewView = require( 'elementor-templates/views/parts/header-parts/preview' ),
	TemplateLibraryHeaderBackView = require( 'elementor-templates/views/parts/header-parts/back' ),
	TemplateLibraryLoadingView = require( 'elementor-templates/views/parts/loading' ),
	TemplateLibraryCollectionView = require( 'elementor-templates/views/parts/templates' ),
	TemplateLibrarySaveTemplateView = require( 'elementor-templates/views/parts/save-template' ),
	TemplateLibraryPreviewView = require( 'elementor-templates/views/parts/preview' ),
	TemplateLibraryLayoutView;

TemplateLibraryLayoutView = Marionette.LayoutView.extend( {
	el: '#elementor-template-library-modal',

	regions: {
		modalContent: '.dialog-message',
		modalHeader: '.dialog-widget-header'
	},

	initialize: function() {
		this.getRegion( 'modalHeader' ).show( new TemplateLibraryHeaderView() );
	},

	getHeaderView: function() {
		return this.getRegion( 'modalHeader' ).currentView;
	},

	showLoadingView: function() {
		this.getRegion( 'modalContent' ).show( new TemplateLibraryLoadingView() );
	},

	showTemplatesView: function( templatesCollection ) {
		this.getRegion( 'modalContent' ).show( new TemplateLibraryCollectionView( {
			collection: templatesCollection
		} ) );

		var headerView = this.getHeaderView();

		headerView.tools.show( new TemplateLibraryHeaderSaveView() );
		headerView.tools2.show( new TemplateLibraryHeaderImportView() );
		headerView.menuArea.show( new TemplateLibraryHeaderMenuView() );
		headerView.logoArea.show( new TemplateLibraryHeaderLogoView() );
	},

	showSaveTemplateView: function( elementModel ) {
		this.getRegion( 'modalContent' ).show( new TemplateLibrarySaveTemplateView( { model: elementModel } ) );

		var headerView = this.getHeaderView();

		headerView.tools.reset();
		headerView.menuArea.reset();
		headerView.logoArea.show( new TemplateLibraryHeaderLogoView() );
	},

	showPreviewView: function( templateModel ) {
		this.getRegion( 'modalContent' ).show( new TemplateLibraryPreviewView( {
			url: templateModel.get( 'url' )
		} ) );

		var headerView = this.getHeaderView();

		headerView.menuArea.reset();

		headerView.tools.show( new TemplateLibraryHeaderPreviewView( {
			model: templateModel
		} ) );

		headerView.logoArea.show( new TemplateLibraryHeaderBackView() );
	}
} );

module.exports = TemplateLibraryLayoutView;

},{"elementor-templates/views/parts/header":16,"elementor-templates/views/parts/header-parts/back":11,"elementor-templates/views/parts/header-parts/logo":12,"elementor-templates/views/parts/header-parts/menu":13,"elementor-templates/views/parts/header-parts/preview":14,"elementor-templates/views/parts/header-parts/save":15,"elementor-templates/views/parts/header-parts/import":17,"elementor-templates/views/parts/loading":18,"elementor-templates/views/parts/preview":19,"elementor-templates/views/parts/save-template":20,"elementor-templates/views/parts/templates":22}],11:[function(require,module,exports){
var TemplateLibraryHeaderBackView;

TemplateLibraryHeaderBackView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-template-library-header-back',

	id: 'elementor-template-library-header-preview-back',

	events: {
		'click': 'onClick'
	},

	onClick: function() {
		elementor.templates.showTemplates();
	}
} );

module.exports = TemplateLibraryHeaderBackView;

},{}],12:[function(require,module,exports){
var TemplateLibraryHeaderLogoView;

TemplateLibraryHeaderLogoView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-template-library-header-logo',

	id: 'elementor-template-library-header-logo',

	events: {
		'click': 'onClick'
	},

	onClick: function() {
		elementor.templates.setTemplatesSource( 'remote' );
		elementor.templates.showTemplates();
	}
} );

module.exports = TemplateLibraryHeaderLogoView;

},{}],13:[function(require,module,exports){
var TemplateLibraryHeaderMenuView;

TemplateLibraryHeaderMenuView = Marionette.ItemView.extend( {
	options: {
		activeClass: 'elementor-active'
	},

	template: '#tmpl-elementor-template-library-header-menu',

	id: 'elementor-template-library-header-menu',

	ui: {
		menuItems: '.elementor-template-library-menu-item'
	},

	events: {
		'click @ui.menuItems': 'onMenuItemClick'
	},

	$activeItem: null,

	activateMenuItem: function( $item ) {
		var activeClass = this.getOption( 'activeClass' );

		if ( this.$activeItem === $item ) {
			return;
		}

		if ( this.$activeItem ) {
			this.$activeItem.removeClass( activeClass );
		}

		$item.addClass( activeClass );

		this.$activeItem = $item;
	},

	onRender: function() {
		var currentSource = elementor.channels.templates.request( 'filter:source' ),
			$sourceItem = this.ui.menuItems.filter( '[data-template-source="' + currentSource + '"]' );

		this.activateMenuItem( $sourceItem );
	},

	onMenuItemClick: function( event ) {
		var item = event.currentTarget;

		this.activateMenuItem( Backbone.$( item ) );

		elementor.templates.setTemplatesSource( item.dataset.templateSource, true );
	}
} );

module.exports = TemplateLibraryHeaderMenuView;

},{}],14:[function(require,module,exports){
var TemplateLibraryHeaderPreviewView;

TemplateLibraryHeaderPreviewView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-template-library-header-preview',

	id: 'elementor-template-library-header-preview',

	ui: {
		insertButton: '#elementor-template-library-header-preview-insert'
	},

	events: {
		'click @ui.insertButton': 'onInsertButtonClick'
	},

	onInsertButtonClick: function() {
		elementor.templates.importTemplate( this.model );
	}
} );

module.exports = TemplateLibraryHeaderPreviewView;

},{}],15:[function(require,module,exports){
var TemplateLibraryHeaderSaveView;

TemplateLibraryHeaderSaveView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-template-library-header-save',

	id: 'elementor-template-library-header-save',

	className: 'elementor-template-library-header-item',

	events: {
		'click': 'onClick'
	},

	onClick: function() {
		elementor.templates.getLayout().showSaveTemplateView();
	}
} );

module.exports = TemplateLibraryHeaderSaveView;

},{}],16:[function(require,module,exports){
var TemplateLibraryHeaderView;

TemplateLibraryHeaderView = Marionette.LayoutView.extend( {

	id: 'elementor-template-library-header',

	template: '#tmpl-elementor-template-library-header',

	regions: {
		logoArea: '#elementor-template-library-header-logo-area',
		tools: '#elementor-template-library-header-tools',
		tools2: '#elementor-template-library-header-tools2',
		menuArea: '#elementor-template-library-header-menu-area'
	},

	ui: {
		closeModal: '#elementor-template-library-header-close-modal'
	},

	events: {
		'click @ui.closeModal': 'onCloseModalClick'
	},

	onCloseModalClick: function() {
		elementor.templates.getModal().hide();
	}
} );

module.exports = TemplateLibraryHeaderView;

},{}],17:[function(require,module,exports){
var TemplateLibraryHeaderImportView;

TemplateLibraryHeaderImportView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-template-library-header-import',

	id: 'elementor-template-library-header-import',

	ui: {
		importFile: '#elementor-template-library-header-import-file'
	},

	className: 'elementor-template-library-header-item',

	events: {
		'change @ui.importFile': 'onImportFileChange'
	},

	onImportFileChange: function(event) {
		var file = event.currentTarget.files[0],
			formData = new FormData();

		formData.append( 'file', file, file.name );

		elementor.templates.getLayout().showLoadingView();
		elementor.ajax.send( 'importTemplate', {
			data: formData,
			processData: false,
			contentType: false,
			success: function( data ) {
				elementor.templates.getTemplatesCollection().add( data );

				elementor.templates.setTemplatesSource( 'local' );

				elementor.templates.showTemplates();
			},
			error: function( data ) {
				elementor.templates.showErrorDialog( data.message );
			}
		} );
	}
} );

module.exports = TemplateLibraryHeaderImportView;

},{}],18:[function(require,module,exports){
var TemplateLibraryLoadingView;

TemplateLibraryLoadingView = Marionette.ItemView.extend( {
	id: 'elementor-template-library-loading',

	template: '#tmpl-elementor-template-library-loading'
} );

module.exports = TemplateLibraryLoadingView;

},{}],19:[function(require,module,exports){
var TemplateLibraryPreviewView;

TemplateLibraryPreviewView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-template-library-preview',

	id: 'elementor-template-library-preview',

	ui: {
		iframe: '> iframe'
	},

	onRender: function() {
		this.ui.iframe.attr( 'src', this.getOption( 'url' ) );
	}
} );

module.exports = TemplateLibraryPreviewView;

},{}],20:[function(require,module,exports){
var TemplateLibrarySaveTemplateView;

TemplateLibrarySaveTemplateView = Marionette.ItemView.extend( {
	id: 'elementor-template-library-save-template',

	template: '#tmpl-elementor-template-library-save-template',

	ui: {
		form: '#elementor-template-library-save-template-form',
		submitButton: '#elementor-template-library-save-template-submit'
	},

	events: {
		'submit @ui.form': 'onFormSubmit'
	},

	onFormSubmit: function( event ) {
		event.preventDefault();

		var formData = this.ui.form.elementorSerializeObject(),
			saveType = this.model ? this.model.get( 'elType' ) : 'page',
			elementsData;

		switch ( saveType ) {
			case 'section':
				elementsData = [ this.model.toJSON() ];
				break;
			case 'widget':
				elementsData = this.model.toJSON();
				break;
			default:
				elementsData = elementor.elements.toJSON();
		}

		_.extend( formData, {
			data: JSON.stringify( elementsData ),
			source: 'local',
			type: saveType
		} );

		if ( 'widget' === formData.type ) {
			formData.widget_type = elementsData.widgetType;
		}

		this.ui.submitButton.addClass( 'elementor-button-state' );

		elementor.ajax.send( 'saveTemplate', {
			data: formData,
			success: function( data ) {
				elementor.templates.getTemplatesCollection().add( data );

				elementor.templates.setTemplatesSource( 'local' );

				elementor.templates.showTemplates();
			},
			error: function( data ) {
				elementor.templates.showErrorDialog( data );
			}
		} );
	}
} );

module.exports = TemplateLibrarySaveTemplateView;

},{}],21:[function(require,module,exports){
var TemplateLibraryTemplatesEmptyView;

TemplateLibraryTemplatesEmptyView = Marionette.ItemView.extend( {
	id: 'elementor-template-library-templates-empty',

	template: '#tmpl-elementor-template-library-templates-empty'
} );

module.exports = TemplateLibraryTemplatesEmptyView;

},{}],22:[function(require,module,exports){
var TemplateLibraryTemplateLocalView = require( 'elementor-templates/views/template/local' ),
	TemplateLibraryTemplateRemoteView = require( 'elementor-templates/views/template/remote' ),
	TemplateLibraryTemplatesEmptyView = require( 'elementor-templates/views/parts/templates-empty' ),
	TemplateLibraryCollectionView;

TemplateLibraryCollectionView = Marionette.CompositeView.extend( {
	template: '#tmpl-elementor-template-library-templates',

	id: 'elementor-template-library-templates',

	childViewContainer: '#elementor-template-library-templates-container',

	emptyView: TemplateLibraryTemplatesEmptyView,

	getChildView: function( childModel ) {
		if ( 'remote' === childModel.get( 'source' ) ) {
			return TemplateLibraryTemplateRemoteView;
		}

		return TemplateLibraryTemplateLocalView;
	},

	initialize: function() {
		this.listenTo( elementor.channels.templates, 'filter:change', this._renderChildren );
	},

	filterByName: function( model ) {
		var filterValue = elementor.channels.templates.request( 'filter:text' );

		if ( ! filterValue ) {
			return true;
		}

		filterValue = filterValue.toLowerCase();

		if ( model.get( 'title' ).toLowerCase().indexOf( filterValue ) >= 0 ) {
			return true;
		}

		return _.any( model.get( 'keywords' ), function( keyword ) {
			return keyword.toLowerCase().indexOf( filterValue ) >= 0;
		} );
	},

	filterBySource: function( model ) {
		var filterValue = elementor.channels.templates.request( 'filter:source' );

		if ( ! filterValue ) {
			return true;
		}

		return filterValue === model.get( 'source' );
	},

	filter: function( childModel ) {
		return this.filterByName( childModel ) && this.filterBySource( childModel );
	},

	onRenderCollection: function() {
		var isEmpty = this.children.isEmpty();

		this.$childViewContainer.attr( 'data-template-source', isEmpty ? 'empty' : elementor.channels.templates.request( 'filter:source' ) );
	}
} );

module.exports = TemplateLibraryCollectionView;

},{"elementor-templates/views/parts/templates-empty":21,"elementor-templates/views/template/local":24,"elementor-templates/views/template/remote":25}],23:[function(require,module,exports){
var TemplateLibraryTemplateView;

TemplateLibraryTemplateView = Marionette.ItemView.extend( {
	className: function() {
		return 'elementor-template-library-template elementor-template-library-template-' + this.model.get( 'source' );
	},

	ui: function() {
		return {
			insertButton: '.elementor-template-library-template-insert',
			previewButton: '.elementor-template-library-template-preview'
		};
	},

	events: function() {
		return {
			'click @ui.insertButton': 'onInsertButtonClick',
			'click @ui.previewButton': 'onPreviewButtonClick'
		};
	},

	onInsertButtonClick: function() {
		elementor.templates.importTemplate( this.model );
	}
} );

module.exports = TemplateLibraryTemplateView;

},{}],24:[function(require,module,exports){
var TemplateLibraryTemplateView = require( 'elementor-templates/views/template/base' ),
	TemplateLibraryTemplateLocalView;

TemplateLibraryTemplateLocalView = TemplateLibraryTemplateView.extend( {
	template: '#tmpl-elementor-template-library-template-local',

	ui: function() {
		return _.extend( TemplateLibraryTemplateView.prototype.ui.apply( this, arguments ), {
			deleteButton: '.elementor-template-library-template-delete'
		} );
	},

	events: function() {
		return _.extend( TemplateLibraryTemplateView.prototype.events.apply( this, arguments ), {
			'click @ui.deleteButton': 'onDeleteButtonClick'
		} );
	},

	onDeleteButtonClick: function() {
		elementor.templates.deleteTemplate( this.model );
	},

	onPreviewButtonClick: function() {
		open( this.model.get( 'url' ), '_blank' );
	}
} );

module.exports = TemplateLibraryTemplateLocalView;

},{"elementor-templates/views/template/base":23}],25:[function(require,module,exports){
var TemplateLibraryTemplateView = require( 'elementor-templates/views/template/base' ),
	TemplateLibraryTemplateRemoteView;

TemplateLibraryTemplateRemoteView = TemplateLibraryTemplateView.extend( {
	template: '#tmpl-elementor-template-library-template-remote',

	onPreviewButtonClick: function() {
		elementor.templates.getLayout().showPreviewView( this.model );
	}
} );

module.exports = TemplateLibraryTemplateRemoteView;

},{"elementor-templates/views/template/base":23}],26:[function(require,module,exports){
/* global ElementorConfig */
var App;

Marionette.TemplateCache.prototype.compileTemplate = function( rawTemplate, options ) {
	options = {
		evaluate: /<#([\s\S]+?)#>/g,
		interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
		escape: /\{\{([^\}]+?)\}\}(?!\})/g
	};

	return _.template( rawTemplate, options );
};

App = Marionette.Application.extend( {
	helpers: require( 'elementor-utils/helpers' ),
	heartbeat: require( 'elementor-utils/heartbeat' ),
	imagesManager: require( 'elementor-utils/images-manager' ),
	schemes: require( 'elementor-utils/schemes' ),
	presetsFactory: require( 'elementor-utils/presets-factory' ),
	modals: require( 'elementor-utils/modals' ),
	introduction: require( 'elementor-utils/introduction' ),
	templates: require( 'elementor-templates/manager' ),
	ajax: require( 'elementor-utils/ajax' ),
	conditions: require( 'elementor-utils/conditions' ),

	channels: {
		editor: Backbone.Radio.channel( 'ELEMENTOR:editor' ),
		data: Backbone.Radio.channel( 'ELEMENTOR:data' ),
		panelElements: Backbone.Radio.channel( 'ELEMENTOR:panelElements' ),
		dataEditMode: Backbone.Radio.channel( 'ELEMENTOR:editmode' ),
		deviceMode: Backbone.Radio.channel( 'ELEMENTOR:deviceMode' ),
		templates: Backbone.Radio.channel( 'ELEMENTOR:templates' )
	},

	// Private Members
	_controlsItemView: null,

	_defaultDeviceMode: 'desktop',

	getElementData: function( modelElement ) {
		var elType = modelElement.get( 'elType' );

		if ( 'widget' === elType ) {
			var widgetType = modelElement.get( 'widgetType' );

			if ( ! this.config.widgets[ widgetType ] ) {
				return false;
			}

			return this.config.widgets[ widgetType ];
		}

		if ( ! this.config.elements[ elType ] ) {
			return false;
		}

		return this.config.elements[ elType ];
	},

	getElementControls: function( modelElement ) {
		var elementData = this.getElementData( modelElement );

		if ( ! elementData ) {
			return false;
		}

		var elType = modelElement.get( 'elType' ),
			isInner = modelElement.get( 'isInner' );

		if ( 'widget' === elType ) {
			return elementData.controls;
		}

		return _.filter( elementData.controls, function( controlData ) {
			return ! ( isInner && controlData.hide_in_inner || ! isInner && controlData.hide_in_top );
		} );
	},

	getControlItemView: function( controlType ) {
		if ( null === this._controlsItemView ) {
			this._controlsItemView = {
				color: require( 'elementor-views/controls/color' ),
				dimensions: require( 'elementor-views/controls/dimensions' ),
				image_dimensions: require( 'elementor-views/controls/image-dimensions' ),
				media: require( 'elementor-views/controls/media' ),
				slider: require( 'elementor-views/controls/slider' ),
				wysiwyg: require( 'elementor-views/controls/wysiwyg' ),
				choose: require( 'elementor-views/controls/choose' ),
				url: require( 'elementor-views/controls/url' ),
				font: require( 'elementor-views/controls/font' ),
				section: require( 'elementor-views/controls/section' ),
				tab: require( 'elementor-views/controls/tab' ),
				repeater: require( 'elementor-views/controls/repeater' ),
				ps_widget: require( 'elementor-views/controls/ps_widget' ),
				icon: require( 'elementor-views/controls/icon' ),
				select2: require( 'elementor-views/controls/select2' ),
				date_time: require( 'elementor-views/controls/date-time' ),
				box_shadow: require( 'elementor-views/controls/box-shadow' ),
				structure: require( 'elementor-views/controls/structure' ),
				animation: require( 'elementor-views/controls/animation' ),
				hover_animation: require( 'elementor-views/controls/animation' ),
				order: require( 'elementor-views/controls/order' )
			};

			this.channels.editor.trigger( 'editor:controls:initialize' );
		}

		return this._controlsItemView[ controlType ] || require( 'elementor-views/controls/base' );
	},

	getPanelView: function() {
		return this.getRegion( 'panel' ).currentView;
	},

	initComponents: function() {
		var EventManager = require( '../utils/hooks' );
		this.hooks = new EventManager();

		this.initDialogsManager();

		this.heartbeat.init();
		this.modals.init();
		this.ajax.init();
	},

	initDialogsManager: function() {
		this.dialogsManager = new DialogsManager.Instance();
	},

	initPreview: function() {
		this.$previewWrapper = Backbone.$( '#elementor-preview' );

		this.$previewResponsiveWrapper = Backbone.$( '#elementor-preview-responsive-wrapper' );

		var previewIframeId = 'elementor-preview-iframe';

		// Make sure the iFrame does not exist.
		if ( ! Backbone.$( '#' + previewIframeId ).length ) {
			var previewIFrame = document.createElement( 'iframe' );

			previewIFrame.id = previewIframeId;
			previewIFrame.src = this.config.preview_link + '&' + ( new Date().getTime() );

			this.$previewResponsiveWrapper.append( previewIFrame );
		}

		this.$preview = Backbone.$( '#' + previewIframeId );

		this.$preview.on( 'load', _.bind( this.onPreviewLoaded, this ) );
	},

	initFrontend: function() {
		elementorFrontend.setScopeWindow( this.$preview[0].contentWindow );

		elementorFrontend.init();
	},

	initClearPageDialog: function() {
		var self = this,
			dialog;

		self.getClearPageDialog = function() {
			if ( dialog ) {
				return dialog;
			}

			dialog = this.dialogsManager.createWidget( 'confirm', {
				id: 'elementor-clear-page-dialog',
				headerMessage: elementor.translate( 'clear_page' ),
				message: elementor.translate( 'dialog_confirm_clear_page' ),
				position: {
					my: 'center center',
					at: 'center center'
				},
				strings: {
					confirm: elementor.translate( 'delete' ),
					cancel: elementor.translate( 'cancel' )
				},
				onConfirm: function() {
					self.getRegion( 'sections' ).currentView.collection.reset();
				}
			} );

			return dialog;
		};
	},

	onStart: function() {
		NProgress.start();
		NProgress.inc( 0.2 );

		this.config = ElementorConfig;

		Backbone.Radio.DEBUG = false;
		Backbone.Radio.tuneIn( 'ELEMENTOR' );

		this.initComponents();

		// Init Base elements collection from the server
		var ElementModel = require( 'elementor-models/element' );

		this.elements = new ElementModel.Collection( this.config.data );

		this.initPreview();

		this.listenTo( this.channels.dataEditMode, 'switch', this.onEditModeSwitched );

		this.setWorkSaver();

		this.initClearPageDialog();
	},

	onPreviewLoaded: function() {
		NProgress.done();

		this.initFrontend();

		this.$previewContents = this.$preview.contents();

		var Preview = require( 'elementor-views/preview' ),
			PanelLayoutView = require( 'elementor-layouts/panel/panel' );
		console.log(Preview);
		var $previewElementorEl = this.$previewContents.find( '#elementor' );

		if ( ! $previewElementorEl.length ) {
			this.onPreviewElNotFound();
			return;
		}

		var iframeRegion = new Marionette.Region( {
			// Make sure you get the DOM object out of the jQuery object
			el: $previewElementorEl[0]
		} );

		this.schemes.init();
		this.schemes.printSchemesStyle();

		this.$previewContents.on( 'submit', function( event ) {
			event.preventDefault();
		} );

		this.$previewContents.on( 'mousedown', function( event ) {
			var $target = Backbone.$( event.target ),
				editMode = elementor.channels.dataEditMode.request( 'activeMode' ),
				isClickInsideElementor = !! $target.closest( '#elementor' ).length,
				isTargetInsideDocument = this.contains( $target[0] );

			if ( isClickInsideElementor && 'preview' !== editMode || ! isTargetInsideDocument ) {
				return;
			}

			$target.closest( 'a' ).attr('onclick', 'return false');
		} );

		this.$previewContents.on( 'click', function( event ) {
			var $target = Backbone.$( event.target ),
				editMode = elementor.channels.dataEditMode.request( 'activeMode' ),
				isClickInsideElementor = !! $target.closest( '#elementor' ).length,
				isTargetInsideDocument = this.contains( $target[0] );

			if ( isClickInsideElementor && 'preview' !== editMode || ! isTargetInsideDocument ) {
				return;
			}

			if ( ! isClickInsideElementor ) {
				elementor.getPanelView().setPage( 'elements' );
			}
		} );

		this.addRegions( {
			sections: iframeRegion,
			panel: '#elementor-panel'
		} );

		this.getRegion( 'sections' ).show( new Preview( {
			collection: this.elements
		} ) );

		this.getRegion( 'panel' ).show( new PanelLayoutView() );

		this.$previewContents
			.children() // <html>
			.addClass( 'elementor-html' )
			.children( 'body' )
			.addClass( 'elementor-editor-active' );

		this.setResizablePanel();

		this.changeDeviceMode( this._defaultDeviceMode );

		Backbone.$( '#elementor-loading, #elementor-preview-loading' ).fadeOut( 600 );

		_.defer( function() {
			elementorFrontend.getScopeWindow().jQuery.holdReady( false );
		} );

		this.enqueueTypographyFonts();

		//this.introduction.startOnLoadIntroduction(); // TEMP Removed

		// carousel fix for device change
		this.$previewContents.on('init', '.slick-slider', function(e, slick) {
			$(elementor.$previewContents[0].defaultView).on('resize.slick', function() {
				slick.windowWidth = 0;
				slick.resize();
			});
		});

		this.trigger( 'preview:loaded' );
	},

	onEditModeSwitched: function() {
		var activeMode = elementor.channels.dataEditMode.request( 'activeMode' );

		if ( 'preview' === activeMode ) {
			this.enterPreviewMode();
		} else {
			this.exitPreviewMode();
		}
	},

	onPreviewElNotFound: function() {
		var dialog = this.dialogsManager.createWidget( 'confirm', {
			id: 'elementor-fatal-error-dialog',
			headerMessage: elementor.translate( 'preview_el_not_found_header' ),
			message: elementor.translate( 'preview_el_not_found_message' ),
			position: {
				my: 'center center',
				at: 'center center'
			},
			strings: {
				confirm: elementor.translate( 'learn_more' ),
				cancel: elementor.translate( 'go_back' )
			},
			onConfirm: function() {
				location.href = location.href.replace( '&force', '' ) + '&force';
			},
			onCancel: function() {
				dialog.hide();
				location.href = elementor.config.edit_post_link;
			},
			hideOnButtonClick: false
		} );

		dialog.show();
	},

	setFlagEditorChange: function( status ) {
		elementor.channels.editor.reply( 'editor:changed', status );
		elementor.channels.editor.trigger( 'editor:changed', status );
	},

	isEditorChanged: function() {
		return ( true === elementor.channels.editor.request( 'editor:changed' ) );
	},

	setWorkSaver: function() {
		Backbone.$( window ).on( 'beforeunload', function() {
			if ( elementor.isEditorChanged() ) {
				return elementor.translate( 'before_unload_alert' );
			}
		} );
	},

	setResizablePanel: function() {
		var self = this,
			side = elementor.config.is_rtl ? 'right' : 'left';

		self.panel.$el.resizable( {
			handles: elementor.config.is_rtl ? 'w' : 'e',
			minWidth: 200,
			maxWidth: 680,
			start: function() {
				self.$previewWrapper
					.addClass( 'ui-resizable-resizing' )
					.css( 'pointer-events', 'none' );
			},
			stop: function() {
				self.$previewWrapper
					.removeClass( 'ui-resizable-resizing' )
					.css( 'pointer-events', '' );

				elementor.channels.data.trigger( 'scrollbar:update' );
			},
			resize: function( event, ui ) {
				self.$previewWrapper
					.css( side, ui.size.width );
			}
		} );
	},

	enterPreviewMode: function() {
		this.$previewContents
			.find( 'body' )
			.add( 'body' )
			.removeClass( 'elementor-editor-active' )
			.addClass( 'elementor-editor-preview' );

		// Handle panel resize
		this.$previewWrapper.css( elementor.config.is_rtl ? 'right' : 'left', '' );

		this.panel.$el.css( 'width', '' );
	},

	exitPreviewMode: function() {
		this.$previewContents
			.find( 'body' )
			.add( 'body' )
			.removeClass( 'elementor-editor-preview' )
			.addClass( 'elementor-editor-active' );
	},

	saveEditor: function( options ) {
		options = _.extend( {
			revision: 'draft',
			onSuccess: null
		}, options );

		NProgress.start();

		return this.ajax.send( 'saveBuilder', {
			data: {
				post_id: this.config.post_id,
				post_type: this.config.post_type,
				lang_id: this.config.lang_id,
				revision: options.revision,
				data: JSON.stringify( elementor.elements.toJSON() )
			},
			success: function( data ) {
				NProgress.done();

				elementor.setFlagEditorChange( false );

				if ( _.isFunction( options.onSuccess ) ) {
					options.onSuccess.call( this, data );
				}
			}
		} );
	},

	reloadPreview: function() {
		Backbone.$( '#elementor-preview-loading' ).show();

		this.$preview[0].contentWindow.location.reload( true );
	},

	clearPage: function() {
		this.getClearPageDialog().show();
	},

	changeDeviceMode: function( newDeviceMode ) {
		var oldDeviceMode = this.channels.deviceMode.request( 'currentMode' );

		if ( oldDeviceMode === newDeviceMode ) {
			return;
		}

		Backbone.$( 'body' )
			.removeClass( 'elementor-device-' + oldDeviceMode )
			.addClass( 'elementor-device-' + newDeviceMode );

		this.channels.deviceMode
			.reply( 'previousMode', oldDeviceMode )
			.reply( 'currentMode', newDeviceMode )
			.trigger( 'change' );
	},

	enqueueTypographyFonts: function() {
		var self = this,
			typographyScheme = this.schemes.getScheme( 'typography' );

		_.each( typographyScheme.items, function( item ) {
			self.helpers.enqueueFont( item.value.font_family );
		} );
	},

	translate: function( stringKey, templateArgs ) {
		var string = this.config.i18n[ stringKey ];

		if ( undefined === string ) {
			string = stringKey;
		}

		if ( templateArgs ) {
			string = string.replace( /{(\d+)}/g, function( match, number ) {
				return undefined !== templateArgs[ number ] ? templateArgs[ number ] : match;
			} );
		}

		return string;
	}
} );

module.exports = ( window.elementor = new App() ).start();

},{"../utils/hooks":100,"elementor-layouts/panel/panel":50,"elementor-models/element":53,"elementor-templates/manager":8,"elementor-utils/ajax":56,"elementor-utils/conditions":57,"elementor-utils/heartbeat":58,"elementor-utils/helpers":59,"elementor-utils/images-manager":60,"elementor-utils/introduction":61,"elementor-utils/modals":64,"elementor-utils/presets-factory":65,"elementor-utils/schemes":66,"elementor-views/controls/animation":71,"elementor-views/controls/base":74,"elementor-views/controls/box-shadow":75,"elementor-views/controls/choose":76,"elementor-views/controls/color":77,"elementor-views/controls/date-time":78,"elementor-views/controls/dimensions":79,"elementor-views/controls/font":80,"elementor-views/controls/icon":82,"elementor-views/controls/image-dimensions":83,"elementor-views/controls/media":84,"elementor-views/controls/order":85,"elementor-views/controls/repeater":87,"elementor-views/controls/section":88,"elementor-views/controls/select2":89,"elementor-views/controls/slider":90,"elementor-views/controls/structure":91,"elementor-views/controls/tab":92,"elementor-views/controls/url":93,"elementor-views/controls/ps_widget":94,"elementor-views/controls/wysiwyg":95,"elementor-views/preview":97}],27:[function(require,module,exports){
var EditModeItemView;

EditModeItemView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-mode-switcher-content',

	id: 'elementor-mode-switcher-inner',

	ui: {
		previewButton: '#elementor-mode-switcher-preview-input',
		previewLabel: '#elementor-mode-switcher-preview',
		previewLabelA11y: '#elementor-mode-switcher-preview .elementor-screen-only'
	},

	events: {
		'change @ui.previewButton': 'onEditModeChange'
	},

	getCurrentMode: function() {
		return this.ui.previewButton.is( ':checked' ) ? 'preview' : 'edit';
	},

	setMode: function( mode ) {
		this.ui.previewButton.prop( 'checked', 'preview' === mode );
	},

	onRender: function() {
		this.onEditModeChange();
	},

	onEditModeChange: function() {
		var dataEditMode = elementor.channels.dataEditMode,
			oldEditMode = dataEditMode.request( 'activeMode' ),
			currentMode = this.getCurrentMode();

		dataEditMode.reply( 'activeMode', currentMode );

		if ( currentMode !== oldEditMode ) {
			dataEditMode.trigger( 'switch' );

			var title = 'preview' === currentMode ? 'Back to Editor' : 'Preview';

			this.ui.previewLabel.attr( 'title', title );
			this.ui.previewLabelA11y.text( title );
		}
	}
} );

module.exports = EditModeItemView;

},{}],28:[function(require,module,exports){
var PanelFooterItemView;

PanelFooterItemView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-panel-footer-content',

	tagName: 'nav',

	id: 'elementor-panel-footer-tools',

	possibleRotateModes: [ 'portrait', 'landscape' ],

	ui: {
		menuButtons: '.elementor-panel-footer-tool',
		deviceModeIcon: '#elementor-panel-footer-responsive > i',
		deviceModeButtons: '#elementor-panel-footer-responsive .elementor-panel-footer-sub-menu-item',
		buttonSave: '#elementor-panel-footer-save',
		buttonSaveButton: '#elementor-panel-footer-save .elementor-button',
		buttonPublish: '#elementor-panel-footer-publish',
		watchTutorial: '#elementor-panel-footer-watch-tutorial',
		showTemplates: '#elementor-panel-footer-templates-modal',
		saveTemplate: '#elementor-panel-footer-save-template'
	},

	events: {
		'click @ui.deviceModeButtons': 'onClickResponsiveButtons',
		'click @ui.buttonSave': 'onClickButtonSave',
		'click @ui.buttonPublish': 'onClickButtonPublish',
		'click @ui.watchTutorial': 'onClickWatchTutorial',
		'click @ui.showTemplates': 'onClickShowTemplates',
		'click @ui.saveTemplate': 'onClickSaveTemplate'
	},

	initialize: function() {
		this._initDialog();

		this.listenTo( elementor.channels.editor, 'editor:changed', this.onEditorChanged )
			.listenTo( elementor.channels.deviceMode, 'change', this.onDeviceModeChange );
	},

	_initDialog: function() {
		var dialog;

		this.getDialog = function() {
			if ( ! dialog ) {
				var $ = Backbone.$,
					$dialogMessage = $( '<div>', {
						'class': 'elementor-dialog-message'
					} ),
					$messageIcon = $( '<i>', {
						'class': 'fa fa-check-circle'
					} ),
					$messageText = $( '<div>', {
						'class': 'elementor-dialog-message-text'
					} ).text( elementor.translate( 'saved' ) );

				$dialogMessage.append( $messageIcon, $messageText );

				dialog = elementor.dialogsManager.createWidget( 'popup', {
					hide: {
						delay: 1500
					}
				} );

				dialog.setMessage( $dialogMessage );
			}

			return dialog;
		};
	},

	_publishBuilder: function() {
		var self = this;

		var options = {
			revision: 'publish',
			onSuccess: function() {
				self.getDialog().show();

				self.ui.buttonSaveButton.removeClass( 'elementor-button-state' );
			}
		};

		self.ui.buttonSaveButton.addClass( 'elementor-button-state' );

		elementor.saveEditor( options );
	},

	_saveBuilderDraft: function() {
		elementor.saveEditor();
	},

	getDeviceModeButton: function( deviceMode ) {
		return this.ui.deviceModeButtons.filter( '[data-device-mode="' + deviceMode + '"]' );
	},

	onPanelClick: function( event ) {
		var $target = Backbone.$( event.target ),
			isClickInsideOfTool = $target.closest( '.elementor-panel-footer-sub-menu-wrapper' ).length;

		if ( isClickInsideOfTool ) {
			return;
		}

		var $tool = $target.closest( '.elementor-panel-footer-tool' ),
			isClosedTool = $tool.length && ! $tool.hasClass( 'elementor-open' );

		this.ui.menuButtons.removeClass( 'elementor-open' );

		if ( isClosedTool ) {
			$tool.addClass( 'elementor-open' );
		}
	},

	onEditorChanged: function() {
		this.ui.buttonSave.toggleClass( 'elementor-save-active', elementor.isEditorChanged() );
	},

	onDeviceModeChange: function() {
		var previousDeviceMode = elementor.channels.deviceMode.request( 'previousMode' ),
			currentDeviceMode = elementor.channels.deviceMode.request( 'currentMode' );

		this.getDeviceModeButton( previousDeviceMode ).removeClass( 'active' );

		this.getDeviceModeButton( currentDeviceMode ).addClass( 'active' );

		// Change the footer icon
		this.ui.deviceModeIcon.removeClass( 'eicon-device-' + previousDeviceMode ).addClass( 'eicon-device-' + currentDeviceMode );
	},

	onClickButtonSave: function() {
		//this._saveBuilderDraft();
		this._publishBuilder();
	},

	onClickButtonPublish: function( event ) {
		// Prevent click on save button
		event.stopPropagation();

		this._publishBuilder();
	},

	onClickResponsiveButtons: function( event ) {
		var $clickedButton = this.$( event.currentTarget ),
			newDeviceMode = $clickedButton.data( 'device-mode' );

		elementor.changeDeviceMode( newDeviceMode );
	},

	onClickWatchTutorial: function() {
		elementor.introduction.startIntroduction();
	},

	onClickShowTemplates: function() {
		elementor.templates.startModal( function() {
			elementor.templates.showTemplates();
		} );
	},

	onClickSaveTemplate: function() {
		elementor.templates.startModal( function() {
			elementor.templates.getLayout().showSaveTemplateView();
		} );
	},

	onRender: function() {
		var self = this;

		_.defer( function() {
			elementor.getPanelView().$el.on( 'click', _.bind( self.onPanelClick, self ) );
		} );
	}
} );

module.exports = PanelFooterItemView;

},{}],29:[function(require,module,exports){
var PanelHeaderItemView;

PanelHeaderItemView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-panel-header',

	id: 'elementor-panel-header',

	ui: {
		menuButton: '#elementor-panel-header-menu-button',
		title: '#elementor-panel-header-title',
		addButton: '#elementor-panel-header-add-button'
	},

	events: {
		'click @ui.addButton': 'onClickAdd',
		'click @ui.menuButton': 'onClickMenu'
	},

	setTitle: function( title ) {
		this.ui.title.html( title );
	},

	onClickAdd: function() {
		elementor.getPanelView().setPage( 'elements' );
	},

	onClickMenu: function() {
		var panel = elementor.getPanelView(),
			currentPanelPageName = panel.getCurrentPageName(),
			nextPage = 'menu' === currentPanelPageName ? 'elements' : 'menu';

		panel.setPage( nextPage );
	}
} );

module.exports = PanelHeaderItemView;

},{}],30:[function(require,module,exports){
var EditorCompositeView;

EditorCompositeView = Marionette.CompositeView.extend( {
	template: Marionette.TemplateCache.get( '#tmpl-editor-content' ),

	id: 'elementor-panel-page-editor',

	templateHelpers: function() {
		return {
			elementData: elementor.getElementData( this.model )
		};
	},

	behaviors: {
		HandleInnerTabs: {
			behaviorClass: require( 'elementor-behaviors/inner-tabs' )
		}
	},

	childViewContainer: '#elementor-controls',

	modelEvents: {
		'destroy': 'onModelDestroy'
	},

	ui: {
		tabs: '.elementor-tabs-controls li',
		reloadButton: '#elementor-update-preview-button'
	},

	events: {
		'click @ui.tabs a': 'onClickTabControl',
		'click @ui.reloadButton': 'onReloadButtonClick'
	},

	initialize: function() {
		this.listenTo( elementor.channels.deviceMode, 'change', this.onDeviceModeChange );
	},

	getChildView: function( item ) {
		var controlType = item.get( 'type' );

		return elementor.getControlItemView( controlType );
	},

	childViewOptions: function() {
		return {
			elementSettingsModel: this.model.get( 'settings' ),
			elementEditSettings: this.model.get( 'editSettings' )
		};
	},

	onDestroy: function() {
		if ( this.editedElementView ) {
			this.editedElementView.$el.removeClass( 'elementor-element-editable' );
		}

		this.model.trigger( 'editor:close' );

		this.triggerMethod( 'editor:destroy' );
	},

	onBeforeRender: function() {
		var controls = elementor.getElementControls( this.model.get( 'settings' ) );

		if ( ! controls ) {
			throw new Error( 'Editor controls not found' );
		}

		// Create new instance of that collection
		this.collection = new Backbone.Collection( controls );
	},

	onRender: function() {
		if ( this.editedElementView ) {
			this.editedElementView.$el.addClass( 'elementor-element-editable' );
		}

		// Set the first tab as active
		this.ui.tabs.eq( 0 ).find( 'a' ).trigger( 'click' );

		// Create tooltip on controls
		this.$( '.tooltip-target' ).tipsy( {
			gravity: function() {
				// `n` for down, `s` for up
				var gravity = Backbone.$( this ).data( 'tooltip-pos' );

				if ( undefined !== gravity ) {
					return gravity;
				} else {
					return 'n';
				}
			},
			title: function() {
				return this.getAttribute( 'data-tooltip' );
			}
		} );
	},

	onModelDestroy: function() {
		this.destroy();
	},

	onClickTabControl: function( event ) {
		event.preventDefault();

		var $thisTab = this.$( event.target );

		this.ui.tabs.removeClass( 'active' );
		$thisTab.closest( 'li' ).addClass( 'active' );

		this.model.get( 'settings' ).trigger( 'control:switch:tab', $thisTab.data( 'tab' ) );

		this.openFirstSectionInCurrentTab( $thisTab.data( 'tab' ) );
	},

	onDeviceModeChange: function() {
		var self = this;

		self.$el.removeClass( 'elementor-responsive-switchers-open' );

		// Timeout according to preview resize css animation duration
		setTimeout( function() {
			elementor.$previewContents.find( 'html, body' ).animate( {
				scrollTop: self.getOption( 'editedElementView' ).$el.offset().top - elementor.$preview[0].contentWindow.innerHeight / 2
			} );
		}, 500 );
	},

	/**
	 * It's a temp method.
	 *
	 * TODO: Rewrite this method later.
	 */
	openFirstSectionInCurrentTab: function( currentTab ) {
		var openedClass = 'elementor-open',

			childrenUnderSection = this.children.filter( function( view ) {
				return ( ! _.isEmpty( view.model.get( 'section' ) ) );
			} ),

			firstSectionControlView = this.children.filter( function( view ) {
				return ( 'section' === view.model.get( 'type' ) ) && ( currentTab === view.model.get( 'tab' ) );
			} );

		// Check if found any section controls
		if ( _.isEmpty( firstSectionControlView ) ) {
			return;
		}

		firstSectionControlView = firstSectionControlView[0];
		firstSectionControlView.ui.heading.addClass( openedClass );

		_.each( childrenUnderSection, function( view ) {
			if ( view.model.get( 'section' ) !== firstSectionControlView.model.get( 'name' ) ) {
				view.$el.removeClass( openedClass );
				return;
			}

			view.$el.addClass( openedClass );
		} );
	},

	onChildviewControlSectionClicked: function( childView ) {
		var openedClass = 'elementor-open',
			sectionClicked = childView.model.get( 'name' ),
			isSectionOpen = childView.ui.heading.hasClass( openedClass ),

			childrenUnderSection = this.children.filter( function( view ) {
				return ( ! _.isEmpty( view.model.get( 'section' ) ) );
			} );

		this.$( '.elementor-control.elementor-control-type-section .elementor-panel-heading' ).removeClass( openedClass );

		if ( isSectionOpen ) {
			// Close all open sections
			sectionClicked = '';
		} else {
			childView.ui.heading.addClass( openedClass );
		}

		_.each( childrenUnderSection, function( view ) {
			if ( view.model.get( 'section' ) !== sectionClicked ) {
				view.$el.removeClass( openedClass );
				return;
			}

			view.$el.addClass( openedClass );
		} );

		elementor.channels.data.trigger( 'scrollbar:update' );
	},

	onReloadButtonClick: function() {
		elementor.reloadPreview();
	}
} );

module.exports = EditorCompositeView;

},{"elementor-behaviors/inner-tabs":4}],31:[function(require,module,exports){
var PanelElementsCategory = require( '../models/element' ),
	PanelElementsCategoriesCollection;

PanelElementsCategoriesCollection = Backbone.Collection.extend( {
	model: PanelElementsCategory
} );

module.exports = PanelElementsCategoriesCollection;

},{"../models/element":34}],32:[function(require,module,exports){
var PanelElementsElementModel = require( '../models/element' ),
	PanelElementsElementsCollection;

PanelElementsElementsCollection = Backbone.Collection.extend( {
	model: PanelElementsElementModel/*,
	comparator: 'title'*/
} );

module.exports = PanelElementsElementsCollection;

},{"../models/element":34}],33:[function(require,module,exports){
var PanelElementsCategoriesCollection = require( './collections/categories' ),
	PanelElementsElementsCollection = require( './collections/elements' ),
	PanelElementsCategoriesView = require( './views/categories' ),
	PanelElementsElementsView = require( './views/elements' ),
	PanelElementsSearchView = require( './views/search' ),
	PanelElementsLayoutView;

PanelElementsLayoutView = Marionette.LayoutView.extend( {
	template: '#tmpl-elementor-panel-elements',

	regions: {
		elements: '#elementor-panel-elements-wrapper',
		search: '#elementor-panel-elements-search-area'
	},

	elementsCollection: null,

	categoriesCollection: null,

	initialize: function() {
		this.listenTo( elementor.channels.panelElements, 'element:selected', this.destroy );
	},

	initElementsCollection: function() {
		var elementsCollection = new PanelElementsElementsCollection(),
			sectionConfig = elementor.config.elements.section;

		elementsCollection.add( {
			title: elementor.translate( 'inner_section' ),
			elType: 'section',
			categories: sectionConfig.categories,
			keywords: sectionConfig.keywords,
			icon: sectionConfig.icon
		} );

		// TODO: Change the array from server syntax, and no need each loop for initialize
		_.each( elementor.config.widgets, function( element ) {
			elementsCollection.add( {
				title: element.title,
				elType: element.elType,
				categories: element.categories,
				keywords: element.keywords,
				icon: element.icon,
				widgetType: element.widget_type,
				custom: element.custom
			} );
		} );

		this.elementsCollection = elementsCollection;
	},

	initCategoriesCollection: function() {
		var categories = {};

		this.elementsCollection.each( function( element ) {
			_.each( element.get( 'categories' ), function( category ) {
				if ( ! categories[ category ] ) {
					categories[ category ] = [];
				}

				categories[ category ].push( element );
			} );
		} );

		var categoriesCollection = new PanelElementsCategoriesCollection();

		_.each( elementor.config.elements_categories, function( categoryConfig, categoryName ) {
			if ( ! categories[ categoryName ] ) {
				return;
			}

			categoriesCollection.add( {
				name: categoryName,
				title: categoryConfig.title,
				icon: categoryConfig.icon,
				items: categories[ categoryName ]
			} );
		} );

		this.categoriesCollection = categoriesCollection;
	},

	showCategoriesView: function() {
		this.getRegion( 'elements' ).show( new PanelElementsCategoriesView( { collection: this.categoriesCollection } ) );
	},

	showElementsView: function() {
		this.getRegion( 'elements' ).show( new PanelElementsElementsView( { collection: this.elementsCollection } ) );
	},

	clearSearchInput: function() {
		this.getChildView( 'search' ).clearInput();
	},

	changeFilter: function( filterValue ) {
		elementor.channels.panelElements
			.reply( 'filter:value', filterValue )
			.trigger( 'change' );
	},

	clearFilters: function() {
		this.changeFilter( null );
		this.clearSearchInput();
	},

	onChildviewChildrenRender: function() {
		this.updateElementsScrollbar();
	},

	onChildviewSearchChangeInput: function( child ) {
		var value = child.ui.input.val();

		if ( _.isEmpty( value ) ) {
			this.showCategoriesView();
		} else {
			var oldValue = elementor.channels.panelElements.request( 'filter:value' );

			if ( _.isEmpty( oldValue ) ) {
				this.showElementsView();
			}
		}

		this.changeFilter( value, 'search' );
	},

	onDestroy: function() {
		elementor.channels.panelElements.reply( 'filter:value', null );
	},

	onShow: function() {
		var searchRegion = this.getRegion( 'search' );

		this.initElementsCollection();

		this.initCategoriesCollection();

		this.showCategoriesView();

		searchRegion.show( new PanelElementsSearchView() );
	},

	updateElementsScrollbar: function() {
		elementor.channels.data.trigger( 'scrollbar:update' );
	}
} );

module.exports = PanelElementsLayoutView;

},{"./collections/categories":31,"./collections/elements":32,"./views/categories":35,"./views/elements":38,"./views/search":39}],34:[function(require,module,exports){
var PanelElementsElementModel;

PanelElementsElementModel = Backbone.Model.extend( {
	defaults: {
		title: '',
		categories: [],
		keywords: [],
		icon: '',
		elType: 'widget',
		widgetType: ''
	}
} );

module.exports = PanelElementsElementModel;

},{}],35:[function(require,module,exports){
var PanelElementsCategoryView = require( './category' ),
	PanelElementsCategoriesView;

PanelElementsCategoriesView = Marionette.CollectionView.extend( {
	childView: PanelElementsCategoryView,

	id: 'elementor-panel-elements-categories'
} );

module.exports = PanelElementsCategoriesView;

},{"./category":36}],36:[function(require,module,exports){
var PanelElementsElementView = require( './element' ),
	PanelElementsElementsCollection = require( '../collections/elements' ),
	PanelElementsCategoryView;

PanelElementsCategoryView = Marionette.CompositeView.extend( {
	template: '#tmpl-elementor-panel-elements-category',

	className: 'elementor-panel-category',

	childView: PanelElementsElementView,

	childViewContainer: '.panel-elements-category-items',

	initialize: function() {
		this.collection = new PanelElementsElementsCollection( this.model.get( 'items' ) );
	}
} );

module.exports = PanelElementsCategoryView;

},{"../collections/elements":32,"./element":37}],37:[function(require,module,exports){
var PanelElementsElementView;

PanelElementsElementView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-element-library-element',

	className: 'elementor-element-wrapper',

	onRender: function() {
		var self = this;

		this.$el.html5Draggable( {

			onDragStart: function() {
				elementor.channels.panelElements
					.reply( 'element:selected', self )
					.trigger( 'element:drag:start' );
			},

			onDragEnd: function() {
				elementor.channels.panelElements.trigger( 'element:drag:end' );
			},

			groups: [ 'elementor-element' ]
		} );
	}
} );

module.exports = PanelElementsElementView;

},{}],38:[function(require,module,exports){
var PanelElementsElementView = require( './element' ),
	PanelElementsElementsView;

PanelElementsElementsView = Marionette.CollectionView.extend( {
	childView: PanelElementsElementView,

	id: 'elementor-panel-elements',

	initialize: function() {
		this.listenTo( elementor.channels.panelElements, 'change', this.onFilterChanged );
	},

	filter: function( childModel ) {
		var filterValue = elementor.channels.panelElements.request( 'filter:value' );

		if ( ! filterValue ) {
			return true;
		}

		if ( -1 !== childModel.get( 'title' ).toLowerCase().indexOf( filterValue.toLowerCase() ) ) {
			return true;
		}

		return _.any( childModel.get( 'keywords' ), function( keyword ) {
			return ( -1 !== keyword.toLowerCase().indexOf( filterValue.toLowerCase() ) );
		} );
	},

	onFilterChanged: function() {
		this._renderChildren();
		this.triggerMethod( 'children:render' );
	}
} );

module.exports = PanelElementsElementsView;

},{"./element":37}],39:[function(require,module,exports){
var PanelElementsSearchView;

PanelElementsSearchView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-panel-element-search',

	id: 'elementor-panel-elements-search-wrapper',

	ui: {
		input: 'input'
	},

	events: {
		'keyup @ui.input': 'onInputChanged'
	},

	onInputChanged: function( event ) {
		var ESC_KEY = 27;

		if ( ESC_KEY === event.keyCode ) {
			this.clearInput();
		}

		this.triggerMethod( 'search:change:input' );
	},

	clearInput: function() {
		this.ui.input.val( '' );
	}
} );

module.exports = PanelElementsSearchView;

},{}],40:[function(require,module,exports){
var PanelMenuItemView = require( 'elementor-panel/pages/menu/views/item' ),
	PanelMenuPageView;

PanelMenuPageView = Marionette.CollectionView.extend( {
	id: 'elementor-panel-page-menu',

	childView: PanelMenuItemView,

	initialize: function() {
		this.collection = new Backbone.Collection( [
			{
				icon: 'paint-brush',
				title: elementor.translate( 'global_colors' ),
				type: 'page',
				pageName: 'colorScheme'
			},
			{
				icon: 'font',
				title: elementor.translate( 'global_fonts' ),
				type: 'page',
				pageName: 'typographyScheme'
			},
			{
				icon: 'eyedropper',
				title: elementor.translate( 'color_picker' ),
				type: 'page',
				pageName: 'colorPickerScheme'
			},
			// {
			// 	icon: 'cog',
			// 	title: elementor.translate( 'elementor_settings' ),
			// 	type: 'link',
			// 	link: elementor.config.settings_page_link,
			// 	newTab: true
			// },
			{
				icon: 'history',
				title: elementor.translate( 'revisions_history' ) + '  <span>(' + elementor.translate( 'soon' ) + ')</span>'
			},
			{
				icon: 'eraser',
				title: elementor.translate( 'clear_page' ),
				callback: function() {
					elementor.clearPage();
				}
			},
			{
				icon: 'info-circle',
				title: elementor.translate( 'about_elementor' ),
				type: 'link',
				link: elementor.config.elementor_site,
				newTab: true
			}
		] );
	},

	onChildviewClick: function( childView ) {
		var menuItemType = childView.model.get( 'type' );

		switch ( menuItemType ) {
			case 'page' :
				var pageName = childView.model.get( 'pageName' ),
					pageTitle = childView.model.get( 'title' );

				elementor.getPanelView().setPage( pageName, pageTitle );
				break;

			case 'link' :
				var link = childView.model.get( 'link' ),
					isNewTab = childView.model.get( 'newTab' );

				if ( isNewTab ) {
					open( link, '_blank' );
				} else {
					location.href = childView.model.get( 'link' );
				}

				break;

			default:
				var callback = childView.model.get( 'callback' );

				if ( _.isFunction( callback ) ) {
					callback.call( childView );
				}
		}
	}
} );

module.exports = PanelMenuPageView;

},{"elementor-panel/pages/menu/views/item":41}],41:[function(require,module,exports){
var PanelMenuItemView;

PanelMenuItemView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-panel-menu-item',

	className: 'elementor-panel-menu-item',

	triggers: {
		click: 'click'
	}
} );

module.exports = PanelMenuItemView;

},{}],42:[function(require,module,exports){
var childViewTypes = {
		color: require( 'elementor-panel/pages/schemes/items/color' ),
		typography: require( 'elementor-panel/pages/schemes/items/typography' )
	},
	PanelSchemeBaseView;

PanelSchemeBaseView = Marionette.CompositeView.extend( {
	id: function() {
		return 'elementor-panel-scheme-' + this.getType();
	},

	className: function() {
		return 'elementor-panel-scheme elementor-panel-scheme-' + this.getUIType();
	},

	childViewContainer: '.elementor-panel-scheme-items',

	getTemplate: function() {
		return Marionette.TemplateCache.get( '#tmpl-elementor-panel-schemes-' + this.getType() );
	},

	getChildView: function() {
		return childViewTypes[ this.getUIType() ];
	},

	getUIType: function() {
		return this.getType();
	},

	ui: function() {
		return {
			saveButton: '.elementor-panel-scheme-save .elementor-button',
			discardButton: '.elementor-panel-scheme-discard .elementor-button',
			resetButton: '.elementor-panel-scheme-reset .elementor-button'
		};
	},

	events: function() {
		return {
			'click @ui.saveButton': 'saveScheme',
			'click @ui.discardButton': 'discardScheme',
			'click @ui.resetButton': 'setDefaultScheme'
		};
	},

	initialize: function() {
		this.model = new Backbone.Model();

		this.resetScheme();
	},

	getType: function() {},

	getScheme: function() {
		return elementor.schemes.getScheme( this.getType() );
	},

	changeChildrenUIValues: function( schemeItems ) {
		var self = this;

		_.each( schemeItems, function( value, key ) {
			var model = self.collection.findWhere( { key: key } ),
				childView = self.children.findByModelCid( model.cid );

			childView.changeUIValue( value );
		} );
	},

	discardScheme: function() {
		elementor.schemes.resetSchemes( this.getType() );

		this.onSchemeChange();

		this.ui.saveButton.prop( 'disabled', true );

		this._renderChildren();
	},

	setSchemeValue: function( key, value ) {
		elementor.schemes.setSchemeValue( this.getType(), key, value );

		this.onSchemeChange();
	},

	saveScheme: function() {
		elementor.schemes.saveScheme( this.getType() );

		this.ui.saveButton.prop( 'disabled', true );

		this.resetScheme();

		this._renderChildren();
	},

	setDefaultScheme: function() {
		var defaultScheme = elementor.config.default_schemes[ this.getType() ].items;

		this.changeChildrenUIValues( defaultScheme );
	},

	resetItems: function() {
		this.model.set( 'items', this.getScheme().items );
	},

	resetCollection: function() {
		var items = this.model.get( 'items' );

		this.collection = new Backbone.Collection();

		_.each( items, _.bind( function( item, key ) {
			item.type = this.getType();
			item.key = key;

			this.collection.add( item );
		}, this ) );
	},

	resetScheme: function() {
		this.resetItems();
		this.resetCollection();
	},

	onSchemeChange: function() {
		elementor.schemes.printSchemesStyle();
	},

	onChildviewValueChange: function( childView, newValue ) {
		this.ui.saveButton.removeProp( 'disabled' );

		this.setSchemeValue( childView.model.get( 'key' ), newValue );
	}
} );

module.exports = PanelSchemeBaseView;

},{"elementor-panel/pages/schemes/items/color":47,"elementor-panel/pages/schemes/items/typography":48}],43:[function(require,module,exports){
var PanelSchemeColorsView = require( 'elementor-panel/pages/schemes/colors' ),
	PanelSchemeColorPickerView;

PanelSchemeColorPickerView = PanelSchemeColorsView.extend( {
	getType: function() {
		return 'color-picker';
	},

	getUIType: function() {
		return 'color';
	},

	onSchemeChange: function() {},

	getViewComparator: function() {
		return this.orderView;
	},

	orderView: function( model ) {
		return elementor.helpers.getColorPickerPaletteIndex( model.get( 'key' ) );
	}
} );

module.exports = PanelSchemeColorPickerView;

},{"elementor-panel/pages/schemes/colors":44}],44:[function(require,module,exports){
var PanelSchemeBaseView = require( 'elementor-panel/pages/schemes/base' ),
	PanelSchemeColorsView;

PanelSchemeColorsView = PanelSchemeBaseView.extend( {
	ui: function() {
		var ui = PanelSchemeBaseView.prototype.ui.apply( this, arguments );

		ui.systemSchemes = '.elementor-panel-scheme-color-system-scheme';

		return ui;
	},

	events: function() {
		var events = PanelSchemeBaseView.prototype.events.apply( this, arguments );

		events[ 'click @ui.systemSchemes' ] = 'onSystemSchemeClick';

		return events;
	},

	getType: function() {
		return 'color';
	},

	onSystemSchemeClick: function( event ) {
		var $schemeClicked = Backbone.$( event.currentTarget ),
			schemeName = $schemeClicked.data( 'schemeName' ),
			scheme = elementor.config.system_schemes[ this.getType() ][ schemeName ].items;

		this.changeChildrenUIValues( scheme );
	}
} );

module.exports = PanelSchemeColorsView;

},{"elementor-panel/pages/schemes/base":42}],45:[function(require,module,exports){
var PanelSchemeDisabledView;

PanelSchemeDisabledView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-panel-schemes-disabled',

	disabledTitle: '',

	templateHelpers: function() {
		return {
			disabledTitle: this.disabledTitle
		};
	},

	id: 'elementor-panel-schemes-disabled'
} );

module.exports = PanelSchemeDisabledView;

},{}],46:[function(require,module,exports){
var PanelSchemeItemView;

PanelSchemeItemView = Marionette.ItemView.extend( {
	getTemplate: function() {
		return Marionette.TemplateCache.get( '#tmpl-elementor-panel-scheme-' + this.getUIType() + '-item' );
	},

	className: function() {
		return 'elementor-panel-scheme-item';
	}
} );

module.exports = PanelSchemeItemView;

},{}],47:[function(require,module,exports){
var PanelSchemeItemView = require( 'elementor-panel/pages/schemes/items/base' ),
	PanelSchemeColorView;

PanelSchemeColorView = PanelSchemeItemView.extend( {
	getUIType: function() {
		return 'color';
	},

	ui: {
		input: '.elementor-panel-scheme-color-value'
	},

	changeUIValue: function( newValue ) {
		this.ui.input.wpColorPicker( 'color', newValue );
	},

	onBeforeDestroy: function() {
		if ( this.ui.input.wpColorPicker( 'instance' ) ) {
			this.ui.input.wpColorPicker( 'close' );
		}
	},

	onRender: function() {
		elementor.helpers.wpColorPicker( this.ui.input, {
			change: _.bind( function( event, ui ) {
				this.triggerMethod( 'value:change', ui.color.toString() );
			}, this )
		} );
	}
} );

module.exports = PanelSchemeColorView;

},{"elementor-panel/pages/schemes/items/base":46}],48:[function(require,module,exports){
var PanelSchemeItemView = require( 'elementor-panel/pages/schemes/items/base' ),
	PanelSchemeTypographyView;

PanelSchemeTypographyView = PanelSchemeItemView.extend( {
	getUIType: function() {
		return 'typography';
	},

	className: function() {
		var classes = PanelSchemeItemView.prototype.className.apply( this, arguments );

		return classes + ' elementor-panel-box';
	},

	ui: {
		heading: '.elementor-panel-heading',
		allFields: '.elementor-panel-scheme-typography-item-field',
		inputFields: 'input.elementor-panel-scheme-typography-item-field',
		selectFields: 'select.elementor-panel-scheme-typography-item-field',
		selectFamilyFields: 'select.elementor-panel-scheme-typography-item-field[name="font_family"]'
	},

	events: {
		'input @ui.inputFields': 'onFieldChange',
		'change @ui.selectFields': 'onFieldChange',
		'click @ui.heading': 'toggleVisibility'
	},

	onRender: function() {
		var self = this;

		this.ui.inputFields.add( this.ui.selectFields ).each( function() {
			var $this = Backbone.$( this ),
				name = $this.attr( 'name' ),
				value = self.model.get( 'value' )[ name ];

			$this.val( value );
		} );

		this.ui.selectFamilyFields.select2( {
			dir: elementor.config.is_rtl ? 'rtl' : 'ltr'
		} );
	},

	toggleVisibility: function() {
		this.ui.heading.toggleClass( 'elementor-open' );
	},

	changeUIValue: function( newValue ) {
		this.ui.allFields.each( function() {
			var $this = Backbone.$( this ),
				thisName = $this.attr( 'name' ),
				newFieldValue = newValue[ thisName ];

			$this.val( newFieldValue ).trigger( 'change' );
		} );
	},

	onFieldChange: function( event ) {
		var $select = this.$( event.currentTarget ),
			currentValue = elementor.schemes.getSchemeValue( 'typography', this.model.get( 'key' ) ).value,
			fieldKey = $select.attr( 'name' );

		currentValue[ fieldKey ] = $select.val();

		if ( 'font_family' === fieldKey && ! _.isEmpty( currentValue[ fieldKey ] ) ) {
			elementor.helpers.enqueueFont( currentValue[ fieldKey ] );
		}

		this.triggerMethod( 'value:change', currentValue );
	}
} );

module.exports = PanelSchemeTypographyView;

},{"elementor-panel/pages/schemes/items/base":46}],49:[function(require,module,exports){
var PanelSchemeBaseView = require( 'elementor-panel/pages/schemes/base' ),
	PanelSchemeTypographyView;

PanelSchemeTypographyView = PanelSchemeBaseView.extend( {
	getType: function() {
		return 'typography';
	}
} );

module.exports = PanelSchemeTypographyView;

},{"elementor-panel/pages/schemes/base":42}],50:[function(require,module,exports){
var EditModeItemView = require( 'elementor-layouts/edit-mode' ),
	PanelLayoutView;

PanelLayoutView = Marionette.LayoutView.extend( {
	template: '#tmpl-elementor-panel',

	id: 'elementor-panel-inner',

	regions: {
		content: '#elementor-panel-content-wrapper',
		header: '#elementor-panel-header-wrapper',
		footer: '#elementor-panel-footer',
		modeSwitcher: '#elementor-mode-switcher'
	},

	pages: {},

	childEvents: {
		'click:add': function() {
			this.setPage( 'elements' );
		},
		'editor:destroy': function() {
			this.setPage( 'elements' );
		}
	},

	currentPageName: null,

	_isScrollbarInitialized: false,

	initialize: function() {
		this.initPages();
	},

	buildPages: function() {
		var pages = {
			elements: {
				view: require( 'elementor-panel/pages/elements/elements' ),
				title: 'NovElementor'
			},
			editor: {
				view: require( 'elementor-panel/pages/editor' )
			},
			menu: {
				view: require( 'elementor-panel/pages/menu/menu' ),
				title: 'NovElementor'
			},
			colorScheme: {
				view: require( 'elementor-panel/pages/schemes/colors' )
			},
			typographyScheme: {
				view: require( 'elementor-panel/pages/schemes/typography' )
			},
			colorPickerScheme: {
				view: require( 'elementor-panel/pages/schemes/color-picker' )
			}
		};

		var schemesTypes = Object.keys( elementor.schemes.getSchemes() ),
			disabledSchemes = _.difference( schemesTypes, elementor.schemes.getEnabledSchemesTypes() );

		_.each( disabledSchemes, function( schemeType ) {
			var scheme  = elementor.schemes.getScheme( schemeType );

			pages[ schemeType + 'Scheme' ].view = require( 'elementor-panel/pages/schemes/disabled' ).extend( {
				disabledTitle: scheme.disabled_title
			} );
		} );

		return pages;
	},

	initPages: function() {
		var pages;

		this.getPages = function( page ) {
			if ( ! pages ) {
				pages = this.buildPages();
			}

			return page ? pages[ page ] : pages;
		};

		this.addPage = function( pageName, pageData ) {
			if ( ! pages ) {
				pages = this.buildPages();
			}

			pages[ pageName ] = pageData;
		};
	},

	getHeaderView: function() {
		return this.getChildView( 'header' );
	},

	getCurrentPageName: function() {
		return this.currentPageName;
	},

	getCurrentPageView: function() {
		return this.getChildView( 'content' );
	},

	setPage: function( page, title, viewOptions ) {
		var pageData = this.getPages( page );

		if ( ! pageData ) {
			throw new ReferenceError( 'Elementor panel doesn\'t have page named \'' + page + '\'' );
		}

		this.showChildView( 'content', new pageData.view( viewOptions ) );

		this.getHeaderView().setTitle( title || pageData.title );

		this.currentPageName = page;
	},

	openEditor: function( model, view ) {
		var currentPageName = this.getCurrentPageName();

		if ( 'editor' === currentPageName ) {
			var currentPageView = this.getCurrentPageView(),
				currentEditableModel = currentPageView.model;

			if ( currentEditableModel === model ) {
				return;
			}
		}

		var elementData = elementor.getElementData( model );

		this.setPage( 'editor', elementor.translate( 'edit_element', [ elementData.title ] ), {
			model: model,
			editedElementView: view
		} );
	},

	onBeforeShow: function() {
		var PanelFooterItemView = require( 'elementor-layouts/panel/footer' ),
			PanelHeaderItemView = require( 'elementor-layouts/panel/header' );

		// Edit Mode
		this.showChildView( 'modeSwitcher', new EditModeItemView() );

		// Header
		this.showChildView( 'header', new PanelHeaderItemView() );

		// Footer
		this.showChildView( 'footer', new PanelFooterItemView() );

		// Added Editor events
		this.updateScrollbar = _.throttle( this.updateScrollbar, 100 );

		this.getRegion( 'content' )
			.on( 'before:show', _.bind( this.onEditorBeforeShow, this ) )
			.on( 'empty', _.bind( this.onEditorEmpty, this ) )
			.on( 'show', _.bind( this.updateScrollbar, this ) );

		// Set default page to elements
		this.setPage( 'elements' );

		this.listenTo( elementor.channels.data, 'scrollbar:update', this.updateScrollbar );
	},

	onEditorBeforeShow: function() {
		_.defer( _.bind( this.updateScrollbar, this ) );
	},

	onEditorEmpty: function() {
		this.updateScrollbar();
	},

	updateScrollbar: function() {
		var $panel = this.content.$el;

		if ( ! this._isScrollbarInitialized ) {
			$panel.perfectScrollbar();
			this._isScrollbarInitialized = true;

			return;
		}

		$panel.perfectScrollbar( 'update' );
	}
} );

module.exports = PanelLayoutView;

},{"elementor-layouts/edit-mode":27,"elementor-layouts/panel/footer":28,"elementor-layouts/panel/header":29,"elementor-panel/pages/editor":30,"elementor-panel/pages/elements/elements":33,"elementor-panel/pages/menu/menu":40,"elementor-panel/pages/schemes/color-picker":43,"elementor-panel/pages/schemes/colors":44,"elementor-panel/pages/schemes/disabled":45,"elementor-panel/pages/schemes/typography":49}],51:[function(require,module,exports){
var BaseSettingsModel;

BaseSettingsModel = Backbone.Model.extend( {

	initialize: function( data ) {
		this.controls = elementor.getElementControls( this );
		if ( ! this.controls ) {
			return;
		}

		var attrs = data || {},
			defaults = {};

		_.each( this.controls, function( field ) {
			var control = elementor.config.controls[ field.type ];

			if ( _.isObject( control.default_value )  ) {
				defaults[ field.name ] = _.extend( {}, control.default_value, field['default'] || {} );
			} else {
				defaults[ field.name ] = field['default'] || control.default_value;
			}
		} );

		this.defaults = defaults;

		// TODO: Change method to recursive
		attrs = _.defaults( {}, attrs, defaults );

		_.each( this.controls, function( field ) {
			if ( 'repeater' === field.type ) {
				attrs[ field.name ] = new Backbone.Collection( attrs[ field.name ], {
					model: BaseSettingsModel
				} );
			}
		} );

		this.set( attrs );
	},

	getFontControls: function() {
		return _.filter( this.controls, function( control ) {
			return 'font' === control.type;
		} );
	},

	getStyleControls: function( controls ) {
		var self = this;

		controls = controls || self.controls;

		return _.filter( controls, function( control ) {
			if ( control.fields ) {
				control.styleFields = self.getStyleControls( control.fields );

				return true;
			}

			return self.isStyleControl( control.name, controls );
		} );
	},

	isStyleControl: function( attribute, controls ) {
		controls = controls || this.controls;

		var currentControl = _.find( controls, function( control ) {
			return attribute === control.name;
		} );

		return currentControl && ! _.isEmpty( currentControl.selectors );
	},

	isClassControl: function( attribute ) {
		var currentControl = _.find( this.controls, function( control ) {
			return attribute === control.name;
		} );

		return currentControl && ! _.isUndefined( currentControl.prefix_class );
	},

	getControl: function( id ) {
		return _.find( this.controls, function( control ) {
			return id === control.name;
		} );
	},

	clone: function() {
		return new BaseSettingsModel( elementor.helpers.cloneObject( this.attributes ) );
	},

	toJSON: function() {
		var data = Backbone.Model.prototype.toJSON.call( this );

		delete data.widgetType;
		delete data.elType;
		delete data.isInner;

		_.each( data, function( attribute, key ) {
			if ( attribute && attribute.toJSON ) {
				data[ key ] = attribute.toJSON();
			}
		} );

		return data;
	}
} );

module.exports = BaseSettingsModel;

},{}],52:[function(require,module,exports){
var BaseSettingsModel = require( 'elementor-models/base-settings' ),
	ColumnSettingsModel;

ColumnSettingsModel = BaseSettingsModel.extend( {
	defaults: {
		_inline_size: '',
		_column_size: 100
	}
} );

module.exports = ColumnSettingsModel;

},{"elementor-models/base-settings":51}],53:[function(require,module,exports){
var BaseSettingsModel = require( 'elementor-models/base-settings' ),
	WidgetSettingsModel = require( 'elementor-models/widget-settings' ),
	ColumnSettingsModel = require( 'elementor-models/column-settings' ),
	SectionSettingsModel = require( 'elementor-models/section-settings' ),

	ElementModel,
	ElementCollection;

ElementModel = Backbone.Model.extend( {
	defaults: {
		id: '',
		elType: '',
		isInner: false,
		settings: {},
		defaultEditSettings: {}
	},

	remoteRender: false,
	_htmlCache: null,
	_jqueryXhr: null,
	renderOnLeave: false,

	initialize: function( options ) {
		var elType = this.get( 'elType' ),
			elements = this.get( 'elements' );

		if ( undefined !== elements ) {
			this.set( 'elements', new ElementCollection( elements ) );
		}

		if ( 'widget' === elType ) {
			this.remoteRender = true;
			this.setHtmlCache( options.htmlCache || '' );
		}

		// No need this variable anymore
		delete options.htmlCache;

		// Make call to remote server as throttle function
		this.renderRemoteServer = _.throttle( this.renderRemoteServer, 1000 );

		var settingModels = {
			widget: WidgetSettingsModel,
			column: ColumnSettingsModel,
			section: SectionSettingsModel
		};

		var SettingsModel = settingModels[ elType ] || BaseSettingsModel,
			settings = this.get( 'settings' ) || {};

		if ( 'widget' === elType ) {
			settings.widgetType = this.get( 'widgetType' );
		}

		settings.elType = elType;
		settings.isInner = this.get( 'isInner' );

		settings = new SettingsModel( settings );

		this.set( 'settings', settings );

		this.initEditSettings();

		this.on( 'destroy', this.onDestroy );
		this.on( 'editor:close', this.onCloseEditor );
	},

	initEditSettings: function() {
		this.set( 'editSettings', new Backbone.Model( this.get( 'defaultEditSettings' ) ) );
	},

	onDestroy: function() {
		// Clean the memory for all use instances
		var settings = this.get( 'settings' ),
			elements = this.get( 'elements' );

		if ( undefined !== elements ) {
			_.each( _.clone( elements.models ), function( model ) {
				model.destroy();
			} );
		}
		settings.destroy();
	},

	onCloseEditor: function() {
		this.initEditSettings();

		if ( this.renderOnLeave ) {
			this.renderRemoteServer();
		}
	},

	setSetting: function( key, value, triggerChange ) {
		triggerChange = triggerChange || false;

		var settings = this.get( 'settings' );

		settings.set( key, value );

		this.set( 'settings', settings );

		if ( triggerChange ) {
			this.trigger( 'change', this );
			this.trigger( 'change:settings', this );
			this.trigger( 'change:settings:' + key, this );
		}
	},

	getSetting: function( key ) {
		var settings = this.get( 'settings' );

		if ( undefined === settings.get( key ) ) {
			return '';
		}

		return settings.get( key );
	},

	setHtmlCache: function( htmlCache ) {
		this._htmlCache = htmlCache;
	},

	getHtmlCache: function() {
		return this._htmlCache;
	},

	getTitle: function() {
		var elementData = elementor.getElementData( this );

		return ( elementData ) ? elementData.title : 'Unknown';
	},

	getIcon: function() {
		var elementData = elementor.getElementData( this );

		return ( elementData ) ? elementData.icon : 'unknown';
	},

	renderRemoteServer: function() {
		if ( ! this.remoteRender ) {
			return;
		}

		this.renderOnLeave = false;

		this.trigger( 'before:remote:render' );

		if ( this._jqueryXhr && 4 !== this._jqueryXhr ) {
			this._jqueryXhr.abort();
		}

		var data = this.toJSON();

		this._jqueryXhr = Backbone.$.post( elementor.config.preview_link, {
			render: 'widget',
			post_id: elementor.config.post_id,
			data: JSON.stringify( data )
		}, _.bind( this.onRemoteGetHtml, this ) );
	},

	onRemoteGetHtml: function( resp ) {
		this.setHtmlCache( resp.data.render );
		this.trigger( 'remote:render' );
	},

	clone: function() {
		var newModel = Backbone.Model.prototype.clone.apply( this, arguments );
		newModel.set( 'id', elementor.helpers.getUniqueID() );

		newModel.setHtmlCache( this.getHtmlCache() );

		var elements = this.get( 'elements' ),
			settings = this.get( 'settings' );

		if ( ! _.isEmpty( elements ) ) {
			newModel.set( 'elements', elements.clone() );
		}

		if ( settings instanceof BaseSettingsModel ) {
			newModel.set( 'settings', settings.clone() );
		}

		return newModel;
	},

	toJSON: function( options ) {
		options = _.extend( { copyHtmlCache: false }, options );

		// Call parent's toJSON method
		var data = Backbone.Model.prototype.toJSON.call( this );

		_.each( data, function( attribute, key ) {
			if ( attribute && attribute.toJSON ) {
				data[ key ] = attribute.toJSON( options );
			}
		} );

		if ( options.copyHtmlCache ) {
			data.htmlCache = this.getHtmlCache();
		} else {
			delete data.htmlCache;
		}

		return data;
	}

} );

ElementCollection = Backbone.Collection.extend( {
	add: function( models, options, isCorrectSet ) {
		if ( ( ! options || ! options.silent ) && ! isCorrectSet ) {
			throw 'Call Error: Adding model to element collection is allowed only by the dedicated addChildModel() method.';
		}

		return Backbone.Collection.prototype.add.call( this, models, options );
	},

	model: function( attrs, options ) {
		if ( attrs.elType ) {
			return new ElementModel( attrs, options );
		}
		return new Backbone.Model( attrs, options );
	},

	clone: function() {
		var tempCollection = Backbone.Collection.prototype.clone.apply( this, arguments ),
			newCollection = new ElementCollection();

		tempCollection.forEach( function( model ) {
			newCollection.add( model.clone(), null, true );
		} );

		return newCollection;
	}
} );

ElementCollection.prototype.sync = function() {
	return null;
};
ElementCollection.prototype.fetch = function() {
	return null;
};
ElementCollection.prototype.save = function() {
	return null;
};

ElementModel.prototype.sync = function() {
	return null;
};
ElementModel.prototype.fetch = function() {
	return null;
};
ElementModel.prototype.save = function() {
	return null;
};

module.exports = {
	Model: ElementModel,
	Collection: ElementCollection
};

},{"elementor-models/base-settings":51,"elementor-models/column-settings":52,"elementor-models/section-settings":54,"elementor-models/widget-settings":55}],54:[function(require,module,exports){
var BaseSettingsModel = require( 'elementor-models/base-settings' ),
	SectionSettingsModel;

SectionSettingsModel = BaseSettingsModel.extend( {
	defaults: {}
} );

module.exports = SectionSettingsModel;

},{"elementor-models/base-settings":51}],55:[function(require,module,exports){
var BaseSettingsModel = require( 'elementor-models/base-settings' ),
	WidgetSettingsModel;

WidgetSettingsModel = BaseSettingsModel.extend( {

} );

module.exports = WidgetSettingsModel;

},{"elementor-models/base-settings":51}],56:[function(require,module,exports){
var Ajax;

Ajax = {
	config: {},

	initConfig: function() {
		this.config = {
			ajaxParams: {
				type: 'POST',
				url: elementor.config.ajaxurl,
				data: {}
			},
			actionPrefix: ''
		};
	},

	init: function() {
		this.initConfig();
	},

	send: function( action, options ) {
		var ajaxParams = elementor.helpers.cloneObject( this.config.ajaxParams );

		options = options || {};

		action = this.config.actionPrefix + action;

		Backbone.$.extend( ajaxParams, options );

		if ( ajaxParams.data instanceof FormData ) {
			ajaxParams.data.append( 'action', action );
			ajaxParams.data.append( '_nonce', elementor.config.nonce );
		} else {
			ajaxParams.data.action = action;
			ajaxParams.data._nonce = elementor.config.nonce;
		}

		var successCallback = ajaxParams.success,
			errorCallback = ajaxParams.error;

		if ( successCallback || errorCallback ) {
			ajaxParams.success = function( response ) {
				if ( response.success && successCallback ) {
					successCallback( response.data );
				}

				if ( ( ! response.success ) && errorCallback ) {
					errorCallback( response.data );
				}
			};

			if ( errorCallback ) {
				ajaxParams.error = function( data ) {
					errorCallback( data );
				};
			}
		}

		return Backbone.$.ajax( ajaxParams );
	}
};

module.exports = Ajax;

},{}],57:[function(require,module,exports){
var Conditions;

Conditions = function() {
	var self = this;

	this.compare = function( leftValue, rightValue, operator ) {
		switch ( operator ) {
			/* jshint ignore:start */
			case '==':
				return leftValue == rightValue;
			case '!=':
				return leftValue != rightValue;
			/* jshint ignore:end */
			case '!==':
				return leftValue !== rightValue;
			case 'in':
				return -1 !== rightValue.indexOf( leftValue );
			case '!in':
				return -1 === rightValue.indexOf( leftValue );
			case '<':
				return leftValue < rightValue;
			case '<=':
				return leftValue <= rightValue;
			case '>':
				return leftValue > rightValue;
			case '>=':
				return leftValue >= rightValue;
			default:
				return leftValue === rightValue;
		}
	};

	this.check = function( conditions, comparisonObject ) {
		var isOrCondition = 'or' === conditions.relation,
			conditionSucceed = ! isOrCondition;

		Backbone.$.each( conditions.terms, function() {
			var term = this,
				comparisonResult;

			if ( term.terms ) {
				comparisonResult = self.check( term, comparisonObject );
			} else {
				var parsedName = term.name.match( /(\w+)(?:\[(\w+)])?/ ),
					value = comparisonObject[ parsedName[ 1 ] ];

				if ( parsedName[ 2 ] ) {
					value = value[ parsedName[ 2 ] ];
				}

				comparisonResult = self.compare( value, term.value, term.operator );
			}

			if ( isOrCondition ) {
				if ( comparisonResult ) {
					conditionSucceed = true;
				}

				return ! comparisonResult;
			}

			if ( ! comparisonResult ) {
				return conditionSucceed = false;
			}
		} );

		return conditionSucceed;
	};
};

module.exports = new Conditions();

},{}],58:[function(require,module,exports){
var heartbeat;

heartbeat = {

	init: function() {
		var modal;

		this.getModal = function() {
			if ( ! modal ) {
				modal = this.initModal();
			}

			return modal;
		};

		Backbone.$( document ).on( {
			'heartbeat-send': function( event, data ) {
				data.elementor_post_lock = {
					post_ID: elementor.config.post_id
				};
			},
			'heartbeat-tick': function( event, response ) {
				if ( response.locked_user ) {
					heartbeat.showLockMessage( response.locked_user );
				} else {
					heartbeat.getModal().hide();
				}

				elementor.config.nonce = response.elementor_nonce;
			}
		} );

		if ( elementor.config.locked_user ) {
			heartbeat.showLockMessage( elementor.config.locked_user );
		}
	},

	initModal: function() {
		var modal = elementor.dialogsManager.createWidget( 'options', {
			headerMessage: elementor.translate( 'take_over' )
		} );

		modal.addButton( {
			name: 'go_back',
			text: elementor.translate( 'go_back' ),
			callback: function() {
				parent.history.go( -1 );
			}
		} );

		modal.addButton( {
			name: 'take_over',
			text: elementor.translate( 'take_over' ),
			callback: function() {
				wp.heartbeat.enqueue( 'elementor_force_post_lock', true );
				wp.heartbeat.connectNow();
			}
		} );

		return modal;
	},

	showLockMessage: function( lockedUser ) {
		var modal = heartbeat.getModal();

		modal
			.setMessage( elementor.translate( 'dialog_user_taken_over', [ lockedUser ] ) )
			.show();
	}
};

module.exports = heartbeat;

},{}],59:[function(require,module,exports){
var helpers;

helpers = {
	_enqueuedFonts: [],

	elementsHierarchy: {
		section: {
			column: {
				widget: null,
				section: null
			}
		}
	},

	enqueueFont: function( font ) {
		if ( -1 !== this._enqueuedFonts.indexOf( font ) ) {
			return;
		}

		var fontType = elementor.config.controls.font.fonts[ font ],
			fontUrl,

			subsets = {
				'ru': 'cyrillic',
				'uk': 'cyrillic',
				'bg': 'cyrillic',
				'vi': 'vietnamese',
				'el': 'greek',
				'he': 'hebrew'
			};

		switch ( fontType ) {
			case 'googlefonts' :
				fontUrl = 'https://fonts.googleapis.com/css?family=' + font + ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

				if ( subsets[ elementor.config.locale ] ) {
					fontUrl += '&subset=' + subsets[ elementor.config.locale ];
				}

				break;

			case 'earlyaccess' :
				var fontLowerString = font.replace( /\s+/g, '' ).toLowerCase();
				fontUrl = 'https://fonts.googleapis.com/earlyaccess/' + fontLowerString + '.css';
				break;
		}

		if ( ! _.isEmpty( fontUrl ) ) {
			elementor.$previewContents.find( 'link:last' ).after( '<link href="' + fontUrl + '" rel="stylesheet" type="text/css">' );
		}
		this._enqueuedFonts.push( font );
	},

	getElementChildType: function( elementType, container ) {
		if ( ! container ) {
			container = this.elementsHierarchy;
		}

		if ( undefined !== container[ elementType ] ) {

			if ( Backbone.$.isPlainObject( container[ elementType ] ) ) {
				return Object.keys( container[ elementType ] );
			}

			return null;
		}

		for ( var type in container ) {

			if ( ! container.hasOwnProperty( type ) ) {
				continue;
			}

			if ( ! Backbone.$.isPlainObject( container[ type ] ) ) {
				continue;
			}

			var result = this.getElementChildType( elementType, container[ type ] );

			if ( result ) {
				return result;
			}
		}

		return null;
	},

	getUniqueID: function() {
		var id;

		// TODO: Check conflict models
		//while ( true ) {
			id = Math.random().toString( 36 ).substr( 2, 7 );
			//if ( 1 > $( 'li.item-id-' + id ).length ) {
				return id;
			//}
		//}
	},

	stringReplaceAll: function( string, replaces ) {
		var re = new RegExp( Object.keys( replaces ).join( '|' ), 'gi' );

		return string.replace( re, function( matched ) {
			return replaces[ matched ];
		} );
	},

	isControlVisible: function( controlModel, values ) {
		var condition;

		// TODO: Better way to get this?
		if ( _.isFunction( controlModel.get ) ) {
			condition = controlModel.get( 'condition' );
		} else {
			condition = controlModel.condition;
		}

		// Repeater items conditions
		if ( controlModel.conditions ) {
			return elementor.conditions.check( controlModel.conditions, values );
		}

		if ( _.isEmpty( condition ) ) {
			return true;
		}

		var hasFields = _.filter( condition, function( conditionValue, conditionName ) {
			var conditionNameParts = conditionName.match( /([a-z_0-9]+)(?:\[([a-z_]+)])?(!?)$/i ),
				conditionRealName = conditionNameParts[1],
				conditionSubKey = conditionNameParts[2],
				isNegativeCondition = !! conditionNameParts[3],
				controlValue = values[ conditionRealName ];

			if ( conditionSubKey && controlValue ) {
				controlValue = controlValue[ conditionSubKey ];
			}

			var isContains = ( _.isArray( conditionValue ) ) ? _.contains( conditionValue, controlValue ) : conditionValue === controlValue;

			return isNegativeCondition ? isContains : ! isContains;
		} );

		return _.isEmpty( hasFields );
	},

	cloneObject: function( object ) {
		return JSON.parse( JSON.stringify( object ) );
	},

	getYoutubeIDFromURL: function( url ) {
		var videoIDParts = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );

		return videoIDParts && videoIDParts[1];
	},

	disableElementEvents: function( $element ) {
		$element.each( function() {
			var currentPointerEvents = this.style.pointerEvents;

			if ( 'none' === currentPointerEvents ) {
				return;
			}

			Backbone.$( this )
				.data( 'backup-pointer-events', currentPointerEvents )
				.css( 'pointer-events', 'none' );
		} );
	},

	enableElementEvents: function( $element ) {
		$element.each( function() {
			var $this = Backbone.$( this ),
				backupPointerEvents = $this.data( 'backup-pointer-events' );

			if ( undefined === backupPointerEvents ) {
				return;
			}

			$this
				.removeData( 'backup-pointer-events' )
				.css( 'pointer-events', backupPointerEvents );
		} );
	},

	getColorPickerPaletteIndex: function( paletteKey ) {
		return [ '7', '8', '1', '5', '2', '3', '6', '4' ].indexOf( paletteKey );
	},

	wpColorPicker: function( $element, options ) {
		var self = this,
			colorPickerScheme = elementor.schemes.getScheme( 'color-picker' ),
			items = _.sortBy( colorPickerScheme.items, function( item ) {
				return self.getColorPickerPaletteIndex( item.key );
			} ),
			defaultOptions = {
				palettes: _.pluck( items, 'value' )
			};

		if ( options ) {
			_.extend( defaultOptions, options );
		}

		return $element.wpColorPicker( defaultOptions );
	}
};

module.exports = helpers;

},{}],60:[function(require,module,exports){
var ImagesManager;

ImagesManager = function() {
	var _this = this;

	var cache = {};

	var debounceDelay = 300;

	var registeredItems = [];

	var getNormalizedSize = function( model ) {
		var size,
			imageSize = model.getSetting( 'image_size' ),
			customDimension = model.getSetting( 'image_custom_dimension' );

		if ( 'custom' === imageSize ) {
			if ( customDimension.width || customDimension.height ) {
				size = 'custom_' + customDimension.width + 'x' + customDimension.height;
			} else {
				return 'full';
			}
		} else {
			size = imageSize;
		}

		return size;
	};

	_this.getItem = function( model ) {
		var size = getNormalizedSize( model ),
			id =  model.getSetting( 'image' ).id;

		if ( ! size ) {
			return false;
		}

		if ( cache[ id ] && cache[ id ][ size ] ) {
			return cache[ id ][ size ];
		}

		return false;
	};

	_this.registerItem = function( model ) {
		if ( '' === model.getSetting( 'image' ).id ) {
			// It's a new dropped widget
			return;
		}

		if ( _this.getItem( model ) ) {
			// It's already in cache
			return;
		}

		registeredItems.push( model );

		_this.debounceGetRemoteItems();
	};

	_this.getRemoteItems = function() {
		var requestedItems = [],
			model,
			index;

		// It's one item, so we can render it from remote server
		if ( 1 === Object.keys( registeredItems ).length ) {
			for ( index in registeredItems ) {
				model = registeredItems[ index ];
			}

			model.renderRemoteServer();
			return;
		}

		for ( index in registeredItems ) {
			model = registeredItems[ index ];

			var size = getNormalizedSize( model ),
				id = model.getSetting( 'image' ).id,
				isFirstTime = ! cache[ id ] || 0 === Object.keys( cache[ id ] ).length;

			requestedItems.push( {
				id: id,
				size: size,
				is_first_time: isFirstTime
			} );
		}

		window.elementor.ajax.send(
			'getImagesDetails', {
				data: {
					items: requestedItems
				},
				success: function( data ) {
					var id,
						size;

					for ( id in data ) {
						if ( ! cache[ id ] ) {
							cache[ id ] = {};
						}

						for ( size in data[ id ] ) {
							cache[ id ][ size ] = data[ id ][ size ];
						}
					}
					registeredItems = [];
				}
			}
		);
	};

	_this.debounceGetRemoteItems = _.debounce( _this.getRemoteItems, debounceDelay );
};

module.exports = new ImagesManager();

},{}],61:[function(require,module,exports){
var Introduction;

Introduction = function() {
	var self = this,
		modal;

	var initModal = function() {
		modal = elementor.dialogsManager.createWidget( 'elementor-modal', {
			id: 'elementor-introduction'
		} );

		modal.getElements( 'closeButton' ).on( 'click', function() {
			self.setIntroductionViewed();
		} );

		modal.on( 'hide', function() {
			modal.getElements( 'message' ).empty(); // In order to stop the video
		} );
	};

	this.getSettings = function() {
		return elementor.config.introduction;
	};

	this.getModal = function() {
		if ( ! modal ) {
			initModal();
		}

		return modal;
	};

	this.startIntroduction = function() {
		var settings = this.getSettings();

		this.getModal()
			.setHeaderMessage( settings.title )
			.setMessage( settings.content )
			.show();
	};

	this.startOnLoadIntroduction = function() {
		var settings = this.getSettings();

		if ( ! settings.is_user_should_view ) {
			return;
		}

		setTimeout( _.bind( function() {
			this.startIntroduction();
		}, this ), settings.delay );
	};

	this.setIntroductionViewed = function() {
		elementor.ajax.send( 'introductionViewed' );
	};
};

module.exports = new Introduction();

},{}],62:[function(require,module,exports){
/**
 * HTML5 - Drag and Drop
 */
;(function( $ ) {

	var hasFullDataTransferSupport = function( event ) {
		try {
			event.originalEvent.dataTransfer.setData( 'test', 'test' );

			event.originalEvent.dataTransfer.clearData( 'test' );

			return true;
		} catch ( e ) {
			return false;
		}
	};

	var Draggable = function( userSettings ) {
		var self = this,
			settings = {},
			elementsCache = {},
			defaultSettings = {
				element: '',
				groups: null,
				onDragStart: null,
				onDragEnd: null
			};

		var initSettings = function() {
			$.extend( true, settings, defaultSettings, userSettings );
		};

		var initElementsCache = function() {
			elementsCache.$element = $( settings.element );
		};

		var buildElements = function() {
			elementsCache.$element.attr( 'draggable', true );
		};

		var onDragEnd = function( event ) {
			if ( $.isFunction( settings.onDragEnd ) ) {
				settings.onDragEnd.call( elementsCache.$element, event, self );
			}
		};

		var onDragStart = function( event ) {
			var groups = settings.groups || [],
				dataContainer = {
					groups: groups
				};

			if ( hasFullDataTransferSupport( event ) ) {
				event.originalEvent.dataTransfer.setData( JSON.stringify( dataContainer ), true );
			}

			if ( $.isFunction( settings.onDragStart ) ) {
				settings.onDragStart.call( elementsCache.$element, event, self );
			}
		};

		var attachEvents = function() {
			elementsCache.$element
				.on( 'dragstart', onDragStart )
				.on( 'dragend', onDragEnd );
		};

		var init = function() {
			initSettings();

			initElementsCache();

			buildElements();

			attachEvents();
		};

		this.destroy = function() {
			elementsCache.$element.off( 'dragstart', onDragStart );

			elementsCache.$element.removeAttr( 'draggable' );
		};

		init();
	};

	var Droppable = function( userSettings ) {
		var self = this,
			settings = {},
			elementsCache = {},
			defaultSettings = {
				element: '',
				items: '>',
				horizontalSensitivity: '10%',
				axis: [ 'vertical', 'horizontal' ],
				groups: null,
				isDroppingAllowed: null,
				onDragEnter: null,
				onDragging: null,
				onDropping: null,
				onDragLeave: null
			};

		var initSettings = function() {
			$.extend( settings, defaultSettings, userSettings );
		};

		var initElementsCache = function() {
			elementsCache.$element = $( settings.element );
		};

		var hasHorizontalDetection = function() {
			return -1 !== settings.axis.indexOf( 'horizontal' );
		};

		var hasVerticalDetection = function() {
			return -1 !== settings.axis.indexOf( 'vertical' );
		};

		var checkHorizontal = function( offsetX, elementWidth ) {
			var isPercentValue,
				sensitivity;

			if ( ! hasHorizontalDetection() ) {
				return false;
			}

			if ( ! hasVerticalDetection() ) {
				return offsetX > elementWidth / 2 ? 'right' : 'left';
			}

			sensitivity = settings.horizontalSensitivity.match( /\d+/ );

			if ( ! sensitivity ) {
				return false;
			}

			sensitivity = sensitivity[ 0 ];

			isPercentValue = /%$/.test( settings.horizontalSensitivity );

			if ( isPercentValue ) {
				sensitivity = elementWidth / sensitivity;
			}

			if ( offsetX > elementWidth - sensitivity ) {
				return 'right';
			} else if ( offsetX < sensitivity ) {
				return 'left';
			}

			return false;
		};

		var getSide = function( element, event ) {
			var $element,
				thisHeight,
				thisWidth,
				side;

			event = event.originalEvent;

			$element = $( element );
			thisHeight = $element.outerHeight();
			thisWidth = $element.outerWidth();

			if ( side = checkHorizontal( event.offsetX, thisWidth ) ) {
				return side;
			}

			if ( ! hasVerticalDetection() ) {
				return false;
			}

			if ( event.offsetY > thisHeight / 2 ) {
				side = 'bottom';
			} else {
				side = 'top';
			}

			return side;
		};

		var isDroppingAllowed = function( element, side, event ) {
			var dataTransferTypes,
				draggableGroups,
				isGroupMatch,
				isDroppingAllowed;

			if ( settings.groups && hasFullDataTransferSupport( event ) ) {

				dataTransferTypes = event.originalEvent.dataTransfer.types;
				isGroupMatch = false;

				dataTransferTypes = Array.prototype.slice.apply( dataTransferTypes ); // Convert to array, since Firefox hold him as DOMStringList

				dataTransferTypes.forEach( function( type ) {
					try {
						draggableGroups = JSON.parse( type );

						if ( ! draggableGroups.groups.slice ) {
							return;
						}

						settings.groups.forEach( function( groupName ) {

							if ( -1 !== draggableGroups.groups.indexOf( groupName ) ) {
								isGroupMatch = true;
								return false; // stops the forEach from extra loops
							}
						} );
					} catch ( e ) {
					}
				} );

				if ( ! isGroupMatch ) {
					return false;
				}
			}

			if ( $.isFunction( settings.isDroppingAllowed ) ) {

				isDroppingAllowed = settings.isDroppingAllowed.call( element, side, event, self );

				if ( ! isDroppingAllowed ) {
					return false;
				}
			}

			return true;
		};

		var onDragEnter = function( event ) {
			if ( event.target !== this ) {
				return;
			}

			// Avoid internal elements event firing
			$( this ).children().each( function() {
				var currentPointerEvents = this.style.pointerEvents;

				if ( 'none' === currentPointerEvents ) {
					return;
				}

				$( this )
					.data( 'backup-pointer-events', currentPointerEvents )
					.css( 'pointer-events', 'none' );
			} );

			var side = getSide( this, event );

			if ( ! isDroppingAllowed( this, side, event ) ) {
				return;
			}

			if ( $.isFunction( settings.onDragEnter ) ) {
				settings.onDragEnter.call( this, side, event, self );
			}
		};

		var onDragOver = function( event ) {
			var side = getSide( this, event );

			if ( ! isDroppingAllowed( this, side, event ) ) {
				return;
			}

			event.preventDefault();

			if ( $.isFunction( settings.onDragging ) ) {
				settings.onDragging.call( this, side, event, self );
			}
		};

		var onDrop = function( event ) {
			var side = getSide( this, event );

			if ( ! isDroppingAllowed( this, side, event ) ) {
				return;
			}

			event.preventDefault();

			if ( $.isFunction( settings.onDropping ) ) {
				settings.onDropping.call( this, side, event, self );
			}
		};

		var onDragLeave = function( event ) {
			// Avoid internal elements event firing
			$( this ).children().each( function() {
				var $this = $( this ),
					backupPointerEvents = $this.data( 'backup-pointer-events' );

				if ( undefined === backupPointerEvents ) {
					return;
				}

				$this
					.removeData( 'backup-pointer-events' )
					.css( 'pointer-events', backupPointerEvents );
			} );

			if ( $.isFunction( settings.onDragLeave ) ) {
				settings.onDragLeave.call( this, event, self );
			}
		};

		var attachEvents = function() {
			elementsCache.$element
				.on( 'dragenter', settings.items, onDragEnter )
				.on( 'dragover', settings.items, onDragOver )
				.on( 'drop', settings.items, onDrop )
				.on( 'dragleave drop', settings.items, onDragLeave );
		};

		var init = function() {
			initSettings();

			initElementsCache();

			attachEvents();
		};

		this.destroy = function() {
			elementsCache.$element
				.off( 'dragenter', settings.items, onDragEnter )
				.off( 'dragover', settings.items, onDragOver )
				.off( 'drop', settings.items, onDrop )
				.off( 'dragleave drop', settings.items, onDragLeave );
		};

		init();
	};

	var plugins = {
		html5Draggable: Draggable,
		html5Droppable: Droppable
	};

	$.each( plugins, function( pluginName, Plugin ) {
		$.fn[ pluginName ] = function( options ) {
			options = options || {};

			this.each( function() {
				var instance = $.data( this, pluginName ),
					hasInstance = instance instanceof Plugin;

				if ( hasInstance ) {

					if ( 'destroy' === options ) {

						instance.destroy();

						$.removeData( this, pluginName );
					}

					return;
				}

				options.element = this;

				$.data( this, pluginName, new Plugin( options ) );
			} );

			return this;
		};
	} );
})( jQuery );

},{}],63:[function(require,module,exports){
/*!
 * jQuery Serialize Object v1.0.1
 */
(function( $ ) {
	$.fn.elementorSerializeObject = function() {
		var serializedArray = this.serializeArray(),
			data = {};

		var parseObject = function( dataContainer, key, value ) {
			var isArrayKey = /^[^\[\]]+\[]/.test( key ),
				isObjectKey = /^[^\[\]]+\[[^\[\]]+]/.test( key ),
				keyName = key.replace( /\[.*/, '' );

			if ( isArrayKey ) {
				if ( ! dataContainer[ keyName ] ) {
					dataContainer[ keyName ] = [];
				}
			} else {
				if ( ! isObjectKey ) {
					if ( dataContainer.push ) {
						dataContainer.push( value );
					} else {
						dataContainer[ keyName ] = value;
					}

					return;
				}

				if ( ! dataContainer[ keyName ] ) {
					dataContainer[ keyName ] = {};
				}
			}

			var nextKeys = key.match( /\[[^\[\]]*]/g );

			nextKeys[ 0 ] = nextKeys[ 0 ].replace( /\[|]/g, '' );

			return parseObject( dataContainer[ keyName ], nextKeys.join( '' ), value );
		};

		$.each( serializedArray, function() {
			parseObject( data, this.name, this.value );
		} );
		return data;
	};
})( jQuery );

},{}],64:[function(require,module,exports){
var Modals;

Modals = {
	init: function() {
		this.initModalWidgetType();
	},

	initModalWidgetType: function() {
		var modalProperties = {
			getDefaultSettings: function() {
				var settings = DialogsManager.getWidgetType( 'options' ).prototype.getDefaultSettings.apply( this, arguments );

				return _.extend( settings, {
					position: {
						my: 'center',
						at: 'center'
					},
					contentWidth: 'auto',
					contentHeight: 'auto',
					closeButton: true
				} );
			},
			buildWidget: function() {
				DialogsManager.getWidgetType( 'options' ).prototype.buildWidget.apply( this, arguments );

				if ( ! this.getSettings( 'closeButton' ) ) {
					return;
				}

				var $closeButton = this.addElement( 'closeButton', '<div><i class="fa fa-times"></i></div>' );

				this.getElements( 'widgetContent' ).prepend( $closeButton );
			},
			attachEvents: function() {
				if ( this.getSettings( 'closeButton' ) ) {
					this.getElements( 'closeButton' ).on( 'click', this.hide );
				}
			},
			onReady: function() {
				DialogsManager.getWidgetType( 'options' ).prototype.onReady.apply( this, arguments );

				var elements = this.getElements(),
					settings = this.getSettings();

				if ( 'auto' !== settings.contentWidth ) {
					elements.message.width( settings.contentWidth );
				}

				if ( 'auto' !== settings.contentHeight ) {
					elements.message.height( settings.contentHeight );
				}
			}
		};

		DialogsManager.addWidgetType( 'elementor-modal', DialogsManager.getWidgetType( 'options' ).extend( 'elementor-modal', modalProperties ) );
	}
};

module.exports = Modals;

},{}],65:[function(require,module,exports){
var presetsFactory;

presetsFactory = {

	getPresetsDictionary: function() {
		return {
			11: 100 / 9,
			12: 100 / 8,
			14: 100 / 7,
			16: 100 / 6,
			33: 100 / 3,
			66: 2 / 3 * 100,
			83: 5 / 6 * 100
		};
	},

	getAbsolutePresetValues: function( preset ) {
		var clonedPreset = elementor.helpers.cloneObject( preset ),
			presetDictionary = this.getPresetsDictionary();

		_.each( clonedPreset, function( unitValue, unitIndex ) {
			if ( presetDictionary[ unitValue ] ) {
				clonedPreset[ unitIndex ] = presetDictionary[ unitValue ];
			}
		} );

		return clonedPreset;
	},

	getPresets: function( columnsCount, presetIndex ) {
		var presets = elementor.helpers.cloneObject( elementor.config.elements.section.presets );

		if ( columnsCount ) {
			presets = presets[ columnsCount ];
		}

		if ( presetIndex ) {
			presets = presets[ presetIndex ];
		}

		return presets;
	},

	getPresetByStructure: function( structure ) {
		var parsedStructure = this.getParsedStructure( structure );

		return this.getPresets( parsedStructure.columnsCount, parsedStructure.presetIndex );
	},

	getParsedStructure: function( structure ) {
		structure += ''; // Make sure this is a string

		return {
			columnsCount: structure.slice( 0, -1 ),
			presetIndex: structure.substr( -1 )
		};
	},

	getPresetSVG: function( preset, svgWidth, svgHeight, separatorWidth ) {
		svgWidth = svgWidth || 100;
		svgHeight = svgHeight || 50;
		separatorWidth = separatorWidth || 2;

		var absolutePresetValues = this.getAbsolutePresetValues( preset ),
			presetSVGPath = this._generatePresetSVGPath( absolutePresetValues, svgWidth, svgHeight, separatorWidth );

		return this._createSVGPreset( presetSVGPath, svgWidth, svgHeight );
	},

	_createSVGPreset: function( presetPath, svgWidth, svgHeight ) {
		var svg = document.createElementNS( 'http://www.w3.org/2000/svg', 'svg' );

		svg.setAttributeNS( 'http://www.w3.org/2000/xmlns/', 'xmlns:xlink', 'http://www.w3.org/1999/xlink' );
		svg.setAttribute( 'viewBox', '0 0 ' + svgWidth + ' ' + svgHeight );

		var path = document.createElementNS( 'http://www.w3.org/2000/svg', 'path' );

		path.setAttribute( 'd', presetPath );

		svg.appendChild( path );

		return svg;
	},

	_generatePresetSVGPath: function( preset, svgWidth, svgHeight, separatorWidth ) {
		var DRAW_SIZE = svgWidth - separatorWidth * ( preset.length - 1 );

		var xPointer = 0,
			dOutput = '';

		for ( var i = 0; i < preset.length; i++ ) {
			if ( i ) {
				dOutput += ' ';
			}

			var increment = preset[ i ] / 100 * DRAW_SIZE;

			xPointer += increment;

			dOutput += 'M' + ( +xPointer.toFixed( 4 ) ) + ',0';

			dOutput += 'V' + svgHeight;

			dOutput += 'H' + ( +( xPointer - increment ).toFixed( 4 ) );

			dOutput += 'V0Z';

			xPointer += separatorWidth;
		}

		return dOutput;
	}
};

module.exports = presetsFactory;

},{}],66:[function(require,module,exports){
var Schemes;

Schemes = function() {
	var self = this,
		styleRules = {},
		schemes = {},
		settings = {
			selectorWrapperPrefix: '.elementor-widget-'
		},
		elements = {};

	var buildUI = function() {
		elements.$previewHead.append( elements.$style );
	};

	var initElements = function() {
		elements.$style = Backbone.$( '<style>', {
			id: 'elementor-style-scheme'
		});

		elements.$previewHead = elementor.$previewContents.find( 'head' );
	};

	var initSchemes = function() {
		schemes = elementor.helpers.cloneObject( elementor.config.schemes.items );
	};

	var addStyleRule = function( selector, property ) {
		if ( ! styleRules[ selector ] ) {
			styleRules[ selector ] = [];
		}

		styleRules[ selector ].push( property );
	};

	var fetchControlStyles = function( control, widgetType ) {
		_.each( control.selectors, function( cssProperty, selector ) {
			var currentSchemeValue = self.getSchemeValue( control.scheme.type, control.scheme.value, control.scheme.key ),
				outputSelector,
				outputCssProperty;

			if ( _.isEmpty( currentSchemeValue.value ) ) {
				return;
			}

			outputSelector = selector.replace( /\{\{WRAPPER\}\}/g, settings.selectorWrapperPrefix + widgetType );
			outputCssProperty = elementor.getControlItemView().replaceStyleValues( cssProperty, currentSchemeValue.value );

			addStyleRule( outputSelector, outputCssProperty );
		} );
	};

	var fetchWidgetControlsStyles = function( widget ) {
		var widgetSchemeControls = self.getWidgetSchemeControls( widget );

		_.each( widgetSchemeControls, function( control ) {
			fetchControlStyles( control, widget.widget_type );
		} );
	};

	var fetchAllWidgetsSchemesStyle = function() {
		_.each( elementor.config.widgets, function( widget ) {
			fetchWidgetControlsStyles(  widget  );
		} );
	};

	var parseSchemeStyle = function() {
		var stringOutput = '';

		_.each( styleRules, function( properties, selector ) {
			stringOutput += selector + '{' + properties.join( '' ) + '}';
		} );

		return stringOutput;
	};

	var resetStyleRules = function() {
		styleRules = {};
	};

	this.init = function() {
		initElements();
		buildUI();
		initSchemes();

		return self;
	};

	this.getWidgetSchemeControls = function( widget ) {
		return _.filter( widget.controls, function( control ) {
			return _.isObject( control.scheme );
		} );
	};

	this.getSchemes = function() {
		return schemes;
	};

	this.getEnabledSchemesTypes = function() {
		return elementor.config.schemes.enabled_schemes;
	};

	this.getScheme = function( schemeType ) {
		return schemes[ schemeType ];
	};

	this.getSchemeValue = function( schemeType, value, key ) {
		if ( this.getEnabledSchemesTypes().indexOf( schemeType ) < 0 ) {
			return false;
		}

		var scheme = self.getScheme( schemeType ),
			schemeValue = scheme.items[ value ];

		if ( key && _.isObject( schemeValue ) ) {
			var clonedSchemeValue = elementor.helpers.cloneObject( schemeValue );

			clonedSchemeValue.value = schemeValue.value[ key ];

			return clonedSchemeValue;
		}

		return schemeValue;
	};

	this.printSchemesStyle = function() {
		resetStyleRules();
		fetchAllWidgetsSchemesStyle();

		elements.$style.text( parseSchemeStyle() );
	};

	this.resetSchemes = function( schemeName ) {
		schemes[ schemeName ] = elementor.helpers.cloneObject( elementor.config.schemes.items[ schemeName ] );
	};

	this.saveScheme = function( schemeName ) {
		elementor.config.schemes.items[ schemeName ].items = elementor.helpers.cloneObject( schemes[ schemeName ].items );

		var itemsToSave = {};

		_.each( schemes[ schemeName ].items, function( item, key ) {
			itemsToSave[ key ] = item.value;
		} );

		NProgress.start();

		elementor.ajax.send( 'applyScheme', {
			data: {
				scheme_name: schemeName,
				data: JSON.stringify( itemsToSave )
			},
			success: function() {
				NProgress.done();
			}
		} );
	};

	this.setSchemeValue = function( schemeName, itemKey, value ) {
		schemes[ schemeName ].items[ itemKey ].value = value;
	};
};

module.exports = new Schemes();

},{}],67:[function(require,module,exports){
( function( $ ) {

	var Stylesheet = function() {
		var self = this,
			rules = {},
			devices = {};

		var getDeviceMaxValue = function( deviceName ) {
			var deviceNames = Object.keys( devices ),
				deviceNameIndex = deviceNames.indexOf( deviceName ),
				nextIndex = deviceNameIndex + 1;

			if ( nextIndex >= deviceNames.length ) {
				throw new RangeError( 'Max value for this device is out of range.' );
			}

			return devices[ deviceNames[ nextIndex ] ] - 1;
		};

		var queryToHash = function( query ) {
			var hash = [];

			$.each( query, function( endPoint ) {
				hash.push( endPoint + '_' + this );
			} );

			return hash.join( '-' );
		};

		var hashToQuery = function( hash ) {
			var query = {};

			hash = hash.split( '-' ).filter( String );

			hash.forEach( function( singleQuery ) {
				var queryParts = singleQuery.split( '_' ),
					endPoint = queryParts[0],
					deviceName = queryParts[1];

				query[ endPoint ] = 'max' === endPoint ? getDeviceMaxValue( deviceName ) : devices[ deviceName ];
			} );

			return query;
		};

		var addQueryHash = function( queryHash ) {
			rules[ queryHash ] = {};

			var hashes = Object.keys( rules );

			if ( hashes.length < 2 ) {
				return;
			}

			// Sort the devices from narrowest to widest
			hashes.sort( function( a, b ) {
				if ( 'all' === a ) {
					return -1;
				}

				if ( 'all' === b ) {
					return 1;
				}

				var aQuery = hashToQuery( a ),
					bQuery = hashToQuery( b );

				return bQuery.max - aQuery.max;
			} );

			var sortedRules = {};

			hashes.forEach( function( deviceName ) {
				sortedRules[ deviceName ] = rules[ deviceName ];
			} );

			rules = sortedRules;
		};

		this.addDevice = function( deviceName, deviceValue ) {
			devices[ deviceName ] = deviceValue;

			var deviceNames = Object.keys( devices );

			if ( deviceNames.length < 2 ) {
				return self;
			}

			// Sort the devices from narrowest to widest
			deviceNames.sort( function( a, b ) {
				return devices[ a ] - devices[ b ];
			} );

			var sortedDevices = {};

			deviceNames.forEach( function( deviceName ) {
				sortedDevices[ deviceName ] = devices[ deviceName ];
			} );

			devices = sortedDevices;

			return self;
		};

		var getQueryHashStyleFormat = function( queryHash ) {
			var query = hashToQuery( queryHash ),
				styleFormat = [];

			$.each( query, function( endPoint ) {
				styleFormat.push( '(' + endPoint + '-width:' + this + 'px)' );
			} );

			return '@media' + styleFormat.join( ' and ' );
		};

		this.addRules = function( selector, styleRules, query ) {
			var queryHash = 'all';

			if ( query ) {
				queryHash = queryToHash( query );
			}

			if ( ! rules[ queryHash ] ) {
				addQueryHash( queryHash );
			}

			if ( ! rules[ queryHash ][ selector ] ) {
				rules[ queryHash ][ selector ] = {};
			}

			if ( 'string' === typeof styleRules ) {
				styleRules = styleRules.split( ';' ).filter( String );

				var orderedRules = {};

				$.each( styleRules, function() {
					var property = this.split( /:(.*)?/ );

					orderedRules[ property[0].trim() ] = property[1].trim().replace( ';', '' );
				} );

				styleRules = orderedRules;
			}

			$.extend( rules[ queryHash ][ selector ], styleRules );

			return self;
		};

		this.empty = function() {
			rules = {};
		};

		this.toString = function() {
			var styleText = '';

			$.each( rules, function( queryHash ) {
				var deviceText = Stylesheet.parseRules( this );

				if ( 'all' !== queryHash ) {
					deviceText = getQueryHashStyleFormat( queryHash ) + '{' + deviceText + '}';
				}

				styleText += deviceText;
			} );

			return styleText;
		};
	};

	Stylesheet.parseRules = function( rules ) {
		var parsedRules = '';

		$.each( rules, function( selector ) {
			var selectorContent = Stylesheet.parseProperties( this );

			if ( selectorContent ) {
				parsedRules += selector + '{' + selectorContent + '}';
			}
		} );

		return parsedRules;
	};

	Stylesheet.parseProperties = function( properties ) {
		var parsedProperties = '';

		$.each( properties, function( propertyKey ) {
			if ( this ) {
				parsedProperties += propertyKey + ':' + this + ';';
			}
		} );

		return parsedProperties;
	};

	module.exports = Stylesheet;
} )( jQuery );

},{}],68:[function(require,module,exports){
var BaseSettingsModel = require( 'elementor-models/base-settings' ),
	Stylesheet = require( 'elementor-utils/stylesheet' ),
	BaseElementView;

BaseElementView = Marionette.CompositeView.extend( {
	tagName: 'div',

	stylesheet: null,

	id: function() {
		return this.getElementUniqueID();
	},

	attributes: function() {
		var type = this.model.get( 'elType' );

		if ( 'widget'  === type ) {
			type = this.model.get( 'widgetType' );
		}
		return {
			'data-element_type': type
		};
	},

	ui: function() {
		return {
			duplicateButton: '> .elementor-editor-element-settings .elementor-editor-element-duplicate',
			removeButton: '> .elementor-editor-element-settings .elementor-editor-element-remove',
			saveButton: '> .elementor-editor-element-settings .elementor-editor-element-save'
		};
	},

	events: function() {
		return {
			'click @ui.removeButton': 'onClickRemove',
			'click @ui.saveButton': 'onClickSave'
		};
	},

	triggers: function() {
		return {
			'click @ui.duplicateButton': 'click:duplicate'
		};
	},

	$stylesheetElement: null,

	getElementType: function() {
		return this.model.get( 'elType' );
	},

	getChildType: function() {
		return elementor.helpers.getElementChildType( this.getElementType() );
	},

	templateHelpers: function() {
		return {
			elementModel: this.model
		};
	},

	getTemplateType: function() {
		return 'js';
	},

	getEditModel: function() {
		return this.model;
	},

	initialize: function() {
		// grab the child collection from the parent model
		// so that we can render the collection as children
		// of this parent element
		this.collection = this.model.get( 'elements' );

		if ( this.collection ) {
			this.listenTo( this.collection, 'add remove reset', this.onCollectionChanged, this );
		}

		var editModel = this.getEditModel();

		this.listenTo( editModel.get( 'settings' ), 'change', this.onSettingsChanged, this );
		this.listenTo( editModel.get( 'editSettings' ), 'change', this.onSettingsChanged, this );

		this.on( 'render', function() {
			this.renderUI();
			this.runReadyTrigger();
		} );

		this.initRemoveDialog();

		this.initStylesheet();
	},

	edit: function() {
		elementor.getPanelView().openEditor( this.getEditModel(), this );
	},

	addChildModel: function( model, options ) {
		return this.collection.add( model, options, true );
	},

	isCollectionFilled: function() {
		return false;
	},

	isInner: function() {
		return !! this.model.get( 'isInner' );
	},

	initRemoveDialog: function() {
		var removeDialog;

		this.getRemoveDialog = function() {
			if ( ! removeDialog ) {
				var elementTitle = this.model.getTitle();

				removeDialog = elementor.dialogsManager.createWidget( 'confirm', {
					message: elementor.translate( 'dialog_confirm_delete', [ elementTitle.toLowerCase() ] ),
					headerMessage: elementor.translate( 'delete_element', [ elementTitle ] ),
					strings: {
						confirm: elementor.translate( 'delete' ),
						cancel: elementor.translate( 'cancel' )
					},
					defaultOption: 'confirm',
					onConfirm: _.bind( function() {
						this.model.destroy();
					}, this )
				} );
			}

			return removeDialog;
		};
	},

	initStylesheet: function() {
		var viewportBreakpoints = elementor.config.viewportBreakpoints;

		this.stylesheet = new Stylesheet();

		this.stylesheet
			.addDevice( 'mobile', 0 )
			.addDevice( 'tablet', viewportBreakpoints.md )
			.addDevice( 'desktop', viewportBreakpoints.lg );
	},

	createStylesheetElement: function() {
		this.$stylesheetElement = Backbone.$( '<style>', { id: 'elementor-style-' + this.model.cid } );

		elementor.$previewContents.find( 'head' ).append( this.$stylesheetElement );
	},

	enqueueFonts: function() {
		var editModel = this.getEditModel(),
			settings = editModel.get( 'settings' );

		_.each( settings.getFontControls(), _.bind( function( control ) {
			var fontFamilyName = editModel.getSetting( control.name );

			if ( _.isEmpty( fontFamilyName ) ) {
				return;
			}

			if ( ! elementor.helpers.isControlVisible( control, settings.attributes ) ) {
				return;
			}

			elementor.helpers.enqueueFont( fontFamilyName );
		}, this ) );
	},

	addStyleRules: function( controls, values, placeholders, replacements ) {
		var self = this;

		_.each( controls, function( control ) {
			if ( control.styleFields ) {
				values[ control.name ].each( function( itemModel ) {
					self.addStyleRules(
						control.styleFields,
						itemModel.attributes,
						_.extend( {}, placeholders, [ '{{CURRENT_ITEM}}' ] ),
						_.extend( {}, replacements, [ '.elementor-repeater-item-' + itemModel.get( '_id' ) ] )
					);
				} );
			}

			self.addControlStyleRules( control, values, placeholders, replacements );
		} );
	},

	addControlStyleRules: function( control, values, placeholders, replacements ) {
		var self = this,
			value = values[ control.name ];

		if ( ! _.isNumber( value ) && _.isEmpty( value ) ) {
			return;
		}

		if ( ! elementor.helpers.isControlVisible( control, values ) ) {
			return;
		}

		_.each( control.selectors, function( cssProperty, selector ) {
			var outputCssProperty = elementor.getControlItemView( control.type ).replaceStyleValues( cssProperty, value ),
				query;

			if ( _.isEmpty( outputCssProperty ) ) {
				return;
			}

			_.each( placeholders, function( placeholder, index ) {
				selector = selector.replace( placeholder, replacements[ index ] );
			} );

			if ( control.responsive && 'desktop' !== control.responsive ) {
				query = { max: control.responsive };
			}

			self.stylesheet.addRules( selector, outputCssProperty, query );
		} );
	},

	addStyleToDocument: function() {
		var styleText = this.stylesheet.toString();

		if ( _.isEmpty( styleText ) && ! this.$stylesheetElement ) {
			return;
		}

		if ( ! this.$stylesheetElement ) {
			this.createStylesheetElement();
		}

		this.$stylesheetElement.text( styleText );
	},

	renderStyles: function() {
		var self = this,
			settings = self.getEditModel().get( 'settings' );

		self.stylesheet.empty();

		self.addStyleRules( settings.getStyleControls(), settings.attributes, [ /\{\{WRAPPER}}/g ], [ '#' + self.getElementUniqueID() ] );

		if ( 'column' === self.model.get( 'elType' ) ) {
			var inlineSize = settings.get( '_inline_size' );

			if ( ! _.isEmpty( inlineSize ) ) {
				self.stylesheet.addRules( '#' + self.getElementUniqueID(), { width: inlineSize + '%' }, { min: 'tablet' } );
			}
		}

		self.addStyleToDocument();
	},

	renderCustomClasses: function() {
		this.$el.addClass( 'elementor-element' );

		var settings = this.getEditModel().get( 'settings' );

		_.each( settings.attributes, _.bind( function( value, attribute ) {
			if ( settings.isClassControl( attribute ) ) {
				var currentControl = settings.getControl( attribute );

				this.$el.removeClass( currentControl.prefix_class + settings.previous( attribute ) );

				var isVisible = elementor.helpers.isControlVisible( currentControl, settings.attributes );

				if ( isVisible && ! _.isEmpty( settings.get( attribute ) ) ) {
					this.$el.addClass( currentControl.prefix_class + settings.get( attribute ) );
					this.$el.addClass( _.result( this, 'className' ) );
				}
			}
		}, this ) );
	},

	renderUI: function() {
		this.renderStyles();
		this.renderCustomClasses();
		this.enqueueFonts();
	},

	runReadyTrigger: function() {
		_.defer( _.bind( function() {
			elementorFrontend.elementsHandler.runReadyTrigger( this.$el );
		}, this ) );
	},

	getElementUniqueID: function() {
		return 'elementor-element-' + this.model.get( 'id' );
	},

	onClickEdit: function( event ) {
		event.preventDefault();
		event.stopPropagation();

		var activeMode = elementor.channels.dataEditMode.request( 'activeMode' );

		if ( 'preview' === activeMode ) {
			return;
		}

		this.edit();
	},

	onCollectionChanged: function() {
		elementor.setFlagEditorChange( true );
	},

	onSettingsChanged: function( settings ) {
		var editModel = this.getEditModel();

		if ( editModel.get( 'editSettings' ) !== settings ) {
			// Change flag only if server settings was changed
			elementor.setFlagEditorChange( true );
		}

		// Make sure is correct model
		if ( settings instanceof BaseSettingsModel ) {
			var isContentChanged = false;

			_.each( settings.changedAttributes(), function( settingValue, settingKey ) {
				var control = settings.getControl( settingKey );

				if ( ! control ) {
					return;
				}

				if ( control.force_render || ! settings.isStyleControl( settingKey ) && ! settings.isClassControl( settingKey ) ) {
					isContentChanged = true;
				}
			} );

			if ( ! isContentChanged ) {
				this.renderUI();
				return;
			}
		}

		// Re-render the template
		var templateType = this.getTemplateType();

		if ( 'js' === templateType ) {
			editModel.setHtmlCache();
			this.render();
			editModel.renderOnLeave = true;
		} else {
			editModel.renderRemoteServer();
		}
	},

	onClickRemove: function( event ) {
		event.preventDefault();
		event.stopPropagation();

		this.getRemoveDialog().show();
	},

	onClickSave: function( event ) {
		event.preventDefault();

		var model = this.model;

		elementor.templates.startModal( function() {
			elementor.templates.getLayout().showSaveTemplateView( model );
		} );
	}
} );

module.exports = BaseElementView;

},{"elementor-models/base-settings":51,"elementor-utils/stylesheet":67}],69:[function(require,module,exports){
var SectionView = require( 'elementor-views/section' ),
	BaseSectionsContainerView;

BaseSectionsContainerView = Marionette.CompositeView.extend( {
	childView: SectionView,

	behaviors: {
		Sortable: {
			behaviorClass: require( 'elementor-behaviors/sortable' ),
			elChildType: 'section'
		},
		HandleDuplicate: {
			behaviorClass: require( 'elementor-behaviors/handle-duplicate' )
		},
		HandleAdd: {
			behaviorClass: require( 'elementor-behaviors/duplicate' )
		},
		HandleElementsRelation: {
			behaviorClass: require( 'elementor-behaviors/elements-relation' )
		}
	},

	getSortableOptions: function() {
		return {
			handle: '> .elementor-container > .elementor-row > .elementor-column > .elementor-element-overlay .elementor-editor-section-settings-list .elementor-editor-element-trigger',
			items: '> .elementor-section'
		};
	},

	getChildType: function() {
		return [ 'section' ];
	},

	isCollectionFilled: function() {
		return false;
	},

	initialize: function() {
		this
			.listenTo( this.collection, 'add remove reset', this.onCollectionChanged )
			.listenTo( elementor.channels.panelElements, 'element:drag:start', this.onPanelElementDragStart )
			.listenTo( elementor.channels.panelElements, 'element:drag:end', this.onPanelElementDragEnd );
	},

	addChildModel: function( model, options ) {
		return this.collection.add( model, options, true );
	},

	addSection: function( properties ) {
		var newSection = {
			id: elementor.helpers.getUniqueID(),
			elType: 'section',
			settings: {},
			elements: []
		};

		if ( properties ) {
			_.extend( newSection, properties );
		}

		var newModel = this.addChildModel( newSection );

		return this.children.findByModelCid( newModel.cid );
	},

	onCollectionChanged: function() {
		elementor.setFlagEditorChange( true );
	},

	onPanelElementDragStart: function() {
		elementor.helpers.disableElementEvents( this.$el.find( 'iframe' ) );
	},

	onPanelElementDragEnd: function() {
		elementor.helpers.enableElementEvents( this.$el.find( 'iframe' ) );
	}
} );

module.exports = BaseSectionsContainerView;

},{"elementor-behaviors/duplicate":1,"elementor-behaviors/elements-relation":2,"elementor-behaviors/handle-duplicate":3,"elementor-behaviors/sortable":6,"elementor-views/section":98}],70:[function(require,module,exports){
var BaseElementView = require( 'elementor-views/base-element' ),
	ElementEmptyView = require( 'elementor-views/element-empty' ),
	WidgetView = require( 'elementor-views/widget' ),
	ColumnView;

ColumnView = BaseElementView.extend( {
	template: Marionette.TemplateCache.get( '#tmpl-elementor-element-column-content' ),

	emptyView: ElementEmptyView,

	childViewContainer: '> .elementor-column-wrap > .elementor-widget-wrap',

	behaviors: {
		Sortable: {
			behaviorClass: require( 'elementor-behaviors/sortable' ),
			elChildType: 'widget'
		},
		Resizable: {
			behaviorClass: require( 'elementor-behaviors/resizable' )
		},
		HandleDuplicate: {
			behaviorClass: require( 'elementor-behaviors/handle-duplicate' )
		},
		HandleAddMode: {
			behaviorClass: require( 'elementor-behaviors/duplicate' )
		},
		HandleElementsRelation: {
			behaviorClass: require( 'elementor-behaviors/elements-relation' )
		}
	},

	getChildView: function( model ) {
		if ( 'section' === model.get( 'elType' ) ) {
			return require( 'elementor-views/section' ); // We need to require the section dynamically
		}

		return WidgetView;
	},

	className: function() {
		var classes = 'elementor-column',
			type = this.isInner() ? 'inner' : 'top';

		classes += ' elementor-' + type + '-column';

		return classes;
	},

	ui: function() {
		var ui = BaseElementView.prototype.ui.apply( this, arguments );

		ui.duplicateButton = '> .elementor-element-overlay .elementor-editor-column-settings-list .elementor-editor-element-duplicate';
		ui.removeButton = '> .elementor-element-overlay .elementor-editor-column-settings-list .elementor-editor-element-remove';
		ui.saveButton = '> .elementor-element-overlay .elementor-editor-column-settings-list .elementor-editor-element-save';
		ui.triggerButton = '> .elementor-element-overlay .elementor-editor-column-settings-list .elementor-editor-element-trigger';
		ui.addButton = '> .elementor-element-overlay .elementor-editor-column-settings-list .elementor-editor-element-add';
		ui.columnTitle = '.column-title';
		ui.columnInner = '> .elementor-column-wrap';
		ui.listTriggers = '> .elementor-element-overlay .elementor-editor-element-trigger';

		return ui;
	},

	triggers: function() {
		var triggers = BaseElementView.prototype.triggers.apply( this, arguments );

		triggers[ 'click @ui.addButton' ] = 'click:new';

		return triggers;
	},

	events: function() {
		var events = BaseElementView.prototype.events.apply( this, arguments );

		events[ 'click @ui.listTriggers' ] = 'onClickTrigger';
		events[ 'click @ui.triggerButton' ] = 'onClickEdit';

		return events;
	},

	initialize: function() {
		BaseElementView.prototype.initialize.apply( this, arguments );

		this.listenTo( elementor.channels.data, 'widget:drag:start', this.onWidgetDragStart );
		this.listenTo( elementor.channels.data, 'widget:drag:end', this.onWidgetDragEnd );
	},

	isDroppingAllowed: function() {
		var elementView = elementor.channels.panelElements.request( 'element:selected' ),
			elType = elementView.model.get( 'elType' );

		if ( 'section' === elType ) {
			return ! this.isInner();
		}

		return 'widget' === elType;
	},

	changeSizeUI: function() {
		var columnSize = this.model.getSetting( '_column_size' ),
			inlineSize = this.model.getSetting( '_inline_size' ),
			columnSizeTitle = parseFloat( inlineSize || columnSize ).toFixed( 1 ) + '%';

		this.$el.attr( 'data-col', columnSize );

		this.ui.columnTitle.html( columnSizeTitle );
	},

	getSortableOptions: function() {
		return {
			connectWith: '.elementor-widget-wrap',
			items: '> .elementor-element'
		};
	},

	// Events
	onCollectionChanged: function() {
		BaseElementView.prototype.onCollectionChanged.apply( this, arguments );

		this.changeChildContainerClasses();
	},

	changeChildContainerClasses: function() {
		var emptyClass = 'elementor-element-empty',
			populatedClass = 'elementor-element-populated';

		if ( this.collection.isEmpty() ) {
			this.ui.columnInner.removeClass( populatedClass ).addClass( emptyClass );
		} else {
			this.ui.columnInner.removeClass( emptyClass ).addClass( populatedClass );
		}
	},

	onRender: function() {
		var self = this;

		self.changeChildContainerClasses();
		self.changeSizeUI();

		self.$el.html5Droppable( {
			items: ' > .elementor-column-wrap > .elementor-widget-wrap > .elementor-element, >.elementor-column-wrap > .elementor-widget-wrap > .elementor-empty-view > .elementor-first-add',
			axis: [ 'vertical' ],
			groups: [ 'elementor-element' ],
			isDroppingAllowed: _.bind( self.isDroppingAllowed, self ),
			onDragEnter: function() {
				self.$el.addClass( 'elementor-dragging-on-child' );
			},
			onDragging: function( side, event ) {
				event.stopPropagation();

				if ( this.dataset.side !== side ) {
					Backbone.$( this ).attr( 'data-side', side );
				}
			},
			onDragLeave: function() {
				self.$el.removeClass( 'elementor-dragging-on-child' );

				Backbone.$( this ).removeAttr( 'data-side' );
			},
			onDropping: function( side, event ) {
				event.stopPropagation();

				var elementView = elementor.channels.panelElements.request( 'element:selected' ),
					newIndex = Backbone.$( this ).index();

				if ( 'bottom' === side ) {
					newIndex++;
				}

				var itemData = {
					id: elementor.helpers.getUniqueID(),
					elType: elementView.model.get( 'elType' )
				};

				if ( 'widget' === itemData.elType ) {
					itemData.widgetType = elementView.model.get( 'widgetType' );
				} else if ( 'section' === itemData.elType ) {
					itemData.elements = [];
					itemData.isInner = true;
				} else {
					return;
				}

				self.triggerMethod( 'request:add', itemData, { at: newIndex } );
			}
		} );
	},

	onClickTrigger: function( event ) {
		event.preventDefault();

		var $trigger = this.$( event.currentTarget ),
			isTriggerActive = $trigger.hasClass( 'elementor-active' );

		this.ui.listTriggers.removeClass( 'elementor-active' );

		if ( ! isTriggerActive ) {
			$trigger.addClass( 'elementor-active' );
		}
	},

	onWidgetDragStart: function() {
		this.$el.addClass( 'elementor-dragging' );
	},

	onWidgetDragEnd: function() {
		this.$el.removeClass( 'elementor-dragging' );
	}
} );

module.exports = ColumnView;

},{"elementor-behaviors/duplicate":1,"elementor-behaviors/elements-relation":2,"elementor-behaviors/handle-duplicate":3,"elementor-behaviors/resizable":5,"elementor-behaviors/sortable":6,"elementor-views/base-element":68,"elementor-views/element-empty":96,"elementor-views/section":98,"elementor-views/widget":99}],71:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlAnimationItemView;

ControlAnimationItemView = ControlBaseItemView.extend( {

	onReady: function() {
		this.ui.select.select2();
	}
} );

module.exports = ControlAnimationItemView;

},{"elementor-views/controls/base":74}],72:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlBaseMultipleItemView;

ControlBaseMultipleItemView = ControlBaseItemView.extend( {

	applySavedValue: function() {
		var values = this.getControlValue(),
			$inputs = this.$( '[data-setting]' ),
			self = this;

		_.each( values, function( value, key ) {
			var $input = $inputs.filter( function() {
				return key === this.dataset.setting;
			} );

			self.setInputValue( $input, value );
		} );
	},

	getControlValue: function( key ) {
		var values = this.elementSettingsModel.get( this.model.get( 'name' ) );

		if ( ! Backbone.$.isPlainObject( values ) ) {
			return {};
		}

		if ( key ) {
			return values[ key ] || '';
		}

		return elementor.helpers.cloneObject( values );
	},

	setValue: function( key, value ) {
		var values = this.getControlValue();

		if ( 'object' === typeof key ) {
			_.each( key, function( internalValue, internalKey ) {
				values[ internalKey ] = internalValue;
			} );
		} else {
			values[ key ] = value;
		}

		this.setSettingsModel( values );
	},

	updateElementModel: function( event ) {
		var inputValue = this.getInputValue( event.currentTarget ),
			key = event.currentTarget.dataset.setting;

		this.setValue( key, inputValue );
	}
}, {
	// Static methods
	replaceStyleValues: function( cssProperty, controlValue ) {
		if ( ! _.isObject( controlValue ) ) {
			return ''; // invalid
		}

		// Trying to retrieve whole the related properties
		// according to the string matches.
		// When one of the properties is empty, aborting
		// the action and returning an empty string.
		try {
			return cssProperty.replace( /\{\{([A-Z]+)}}/g, function( fullMatch, pureMatch ) {
				var value = controlValue[ pureMatch.toLowerCase() ];

				if ( '' === value ) {
					throw '';
				}

				if ( pureMatch == 'URL' && ! /^(https?:)?\/\//i.test( value ) ) {
					value = elementor.config.home_url + value;
				}

				return value;
			} );
		} catch ( exception ) {
			return '';
		}
	}
} );

module.exports = ControlBaseMultipleItemView;

},{"elementor-views/controls/base":74}],73:[function(require,module,exports){
var ControlBaseMultipleItemView = require( 'elementor-views/controls/base-multiple' ),
	ControlBaseUnitsItemView;

ControlBaseUnitsItemView = ControlBaseMultipleItemView.extend( {

	getCurrentRange: function() {
		return this.getUnitRange( this.getControlValue( 'unit' ) );
	},

	getUnitRange: function( unit ) {
		var ranges = this.model.get( 'range' );

		if ( ! ranges || ! ranges[ unit ] ) {
			return false;
		}

		return ranges[ unit ];
	}
} );

module.exports = ControlBaseUnitsItemView;

},{"elementor-views/controls/base-multiple":72}],74:[function(require,module,exports){
var ControlBaseItemView;

ControlBaseItemView = Marionette.CompositeView.extend( {
	ui: function() {
		return {
			input: 'input[data-setting][type!="checkbox"][type!="radio"]',
			checkbox: 'input[data-setting][type="checkbox"]',
			radio: 'input[data-setting][type="radio"]',
			select: 'select[data-setting]',
			textarea: 'textarea[data-setting]',
			controlTitle: '.elementor-control-title',
			responsiveSwitchers: '.elementor-responsive-switcher',
			switcherDesktop: '.elementor-responsive-switcher-desktop'
		};
	},

	className: function() {
		// TODO: Any better classes for that?
		var classes = 'elementor-control elementor-control-' + this.model.get( 'name' ) + ' elementor-control-type-' + this.model.get( 'type' ),
			modelClasses = this.model.get( 'classes' ),
			responsiveControl = this.model.get( 'responsive' );

		if ( ! _.isEmpty( modelClasses ) ) {
			classes += ' ' + modelClasses;
		}

		if ( ! _.isEmpty( this.model.get( 'section' ) ) ) {
			classes += ' elementor-control-under-section';
		}

		if ( ! _.isEmpty( responsiveControl ) ) {
			classes += ' elementor-control-responsive-' + responsiveControl;
		}

		return classes;
	},

	getTemplate: function() {
		return Marionette.TemplateCache.get( '#tmpl-elementor-control-' + this.model.get( 'type' ) + '-content' );
	},

	templateHelpers: function() {
		var controlData = {
			controlValue: this.getControlValue(),
			_cid: this.model.cid
		};

		return {
			data: _.extend( {}, this.model.toJSON(), controlData )
		};
	},

	baseEvents: {
		'input @ui.input': 'onBaseInputChange',
		'change @ui.checkbox': 'onBaseInputChange',
		'change @ui.radio': 'onBaseInputChange',
		'input @ui.textarea': 'onBaseInputChange',
		'change @ui.select': 'onBaseInputChange',
		'click @ui.switcherDesktop': 'onSwitcherDesktopClick',
		'click @ui.responsiveSwitchers': 'onSwitcherClick'
	},

	childEvents: {},

	events: function() {
		return _.extend( {}, this.baseEvents, this.childEvents );
	},

	initialize: function( options ) {
		this.elementSettingsModel = options.elementSettingsModel;

		var controlType = this.model.get( 'type' ),
			controlSettings = Backbone.$.extend( true, {}, elementor.config.controls[ controlType ], this.model.attributes );

		this.model.set( controlSettings );

		this.listenTo( this.elementSettingsModel, 'change', this.toggleControlVisibility );
		this.listenTo( this.elementSettingsModel, 'control:switch:tab', this.onControlSwitchTab );
	},

	getControlValue: function() {
		return this.elementSettingsModel.get( this.model.get( 'name' ) );
	},

	isValidValue: function( value ) {
		return true;
	},

	setValue: function( value ) {
		this.setSettingsModel( value );
	},

	setSettingsModel: function( value ) {
		if ( true !== this.isValidValue( value ) ) {
			this.triggerMethod( 'settings:error' );
			return;
		}

		this.elementSettingsModel.set( this.model.get( 'name' ), value );

		this.triggerMethod( 'settings:change' );
	},

	applySavedValue: function() {
		this.setInputValue( '[data-setting="' + this.model.get( 'name' ) + '"]', this.getControlValue() );
	},

	getEditSettings: function( setting ) {
		var settings = this.getOption( 'elementEditSettings' ).toJSON();

		if ( setting ) {
			return settings[ setting ];
		}

		return settings;
	},

	setEditSetting: function( settingKey, settingValue ) {
		var settings = this.getOption( 'elementEditSettings' );

		settings.set( settingKey, settingValue );
	},

	getInputValue: function( input ) {
		var $input = this.$( input ),
			inputValue = $input.val(),
			inputType = $input.attr( 'type' );

		if ( -1 !== [ 'radio', 'checkbox' ].indexOf( inputType ) ) {
			return $input.prop( 'checked' ) ? inputValue : '';
		}

		return inputValue;
	},

	setInputValue: function( input, value ) {
		var $input = this.$( input ),
			inputType = $input.attr( 'type' );

		if ( 'checkbox' === inputType ) {
			$input.prop( 'checked', !! value );
		} else if ( 'radio' === inputType ) {
			$input.filter( '[value="' + value + '"]' ).prop( 'checked', true );
		} else if ( 'select2' === inputType ) {
			// don't touch
		} else {
			$input.val( value );
		}
	},

	onSettingsError: function() {
		this.$el.addClass( 'elementor-error' );
	},

	onSettingsChange: function() {
		this.$el.removeClass( 'elementor-error' );
	},

	onRender: function() {
		this.applySavedValue();

		var layoutType = this.model.get( 'label_block' ) ? 'block' : 'inline',
			showLabel = this.model.get( 'show_label' ),
			elClasses = 'elementor-label-' + layoutType;

		elClasses += ' elementor-control-separator-' + this.model.get( 'separator' );

		if ( ! showLabel ) {
			elClasses += ' elementor-control-hidden-label';
		}

		this.$el.addClass( elClasses );
		this.renderResponsiveSwitchers();

		this.triggerMethod( 'ready' );
		this.toggleControlVisibility();
	},

	onBaseInputChange: function( event ) {
		this.updateElementModel( event );

		this.triggerMethod( 'input:change', event );
	},

	onSwitcherClick: function( event ) {
		var device = Backbone.$( event.currentTarget ).data( 'device' );

		elementor.changeDeviceMode( device );
	},

	onSwitcherDesktopClick: function() {
		elementor.getPanelView().getCurrentPageView().$el.toggleClass( 'elementor-responsive-switchers-open' );
	},

	renderResponsiveSwitchers: function() {
		if ( _.isEmpty( this.model.get( 'responsive' ) ) ) {
			return;
		}

		var templateHtml = Backbone.$( '#tmpl-elementor-control-responsive-switchers' ).html();

		this.ui.controlTitle.after( templateHtml );
	},

	toggleControlVisibility: function() {
		var isVisible = elementor.helpers.isControlVisible( this.model, this.elementSettingsModel.attributes );

		this.$el.toggleClass( 'elementor-hidden-control', ! isVisible );

		elementor.channels.data.trigger( 'scrollbar:update' );
	},

	onControlSwitchTab: function( activeTab ) {
		this.$el.toggleClass( 'elementor-active-tab', ( activeTab === this.model.get( 'tab' ) ) );

		elementor.channels.data.trigger( 'scrollbar:update' );
	},

	onReady: function() {},

	updateElementModel: function( event ) {
		this.setValue( this.getInputValue( event.currentTarget ) );
	}
}, {
	// Static methods
	replaceStyleValues: function( cssProperty, controlValue ) {
		var replaceArray = { '\{\{VALUE\}\}': controlValue };

		return elementor.helpers.stringReplaceAll( cssProperty, replaceArray );
	}
} );

module.exports = ControlBaseItemView;

},{}],75:[function(require,module,exports){
var ControlMultipleBaseItemView = require( 'elementor-views/controls/base-multiple' ),
	ControlBoxShadowItemView;

ControlBoxShadowItemView = ControlMultipleBaseItemView.extend( {
	ui: function() {
		var ui = ControlMultipleBaseItemView.prototype.ui.apply( this, arguments );

		ui.sliders = '.elementor-slider';
		ui.colors = '.elementor-box-shadow-color-picker';

		return ui;
	},

	childEvents: {
		'slide @ui.sliders': 'onSlideChange'
	},

	initSliders: function() {
		var value = this.getControlValue();

		this.ui.sliders.each( function() {
			var $slider = Backbone.$( this ),
				$input = $slider.next( '.elementor-slider-input' ).find( 'input' );

			$slider.slider( {
				value: value[ this.dataset.input ],
				min: +$input.attr( 'min' ),
				max: +$input.attr( 'max' )
			} );
		} );
	},

	initColors: function() {
		var self = this;

		elementor.helpers.wpColorPicker( this.ui.colors, {
			change: function() {
				var $this = Backbone.$( this ),
					type = $this.data( 'setting' );

				self.setValue( type, $this.wpColorPicker( 'color' ) );
			},

			clear: function() {
				self.setValue( this.dataset.setting, '' );
			},

			width: 251
		} );
	},

	onInputChange: function( event ) {
		var type = event.currentTarget.dataset.setting,
			$slider = this.ui.sliders.filter( '[data-input="' + type + '"]' );

		$slider.slider( 'value', this.getControlValue( type ) );
	},

	onReady: function() {
		this.initSliders();
		this.initColors();
	},

	onSlideChange: function( event, ui ) {
		var type = event.currentTarget.dataset.input,
			$input = this.ui.input.filter( '[data-setting="' + type + '"]' );

		$input.val( ui.value );
		this.setValue( type, ui.value );
	},

	onBeforeDestroy: function() {
		this.ui.colors.each( function() {
			var $color = Backbone.$( this );

			if ( $color.wpColorPicker( 'instance' ) ) {
				$color.wpColorPicker( 'close' );
			}
		} );

		this.$el.remove();
	}
} );

module.exports = ControlBoxShadowItemView;

},{"elementor-views/controls/base-multiple":72}],76:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlChooseItemView;

ControlChooseItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.inputs = '[type="radio"]';

		return ui;
	},

	childEvents: {
		'mousedown label': 'onMouseDownLabel',
		'click @ui.inputs': 'onClickInput',
		'change @ui.inputs': 'updateElementModel'
	},

	onMouseDownLabel: function( event ) {
		var $clickedLabel = this.$( event.currentTarget ),
			$selectedInput = this.$( '#' + $clickedLabel.attr( 'for' ) );

		$selectedInput.data( 'checked', $selectedInput.prop( 'checked' ) );
	},

	onClickInput: function( event ) {
		if ( ! this.model.get( 'toggle' ) ) {
			return;
		}

		var $selectedInput = this.$( event.currentTarget );

		if ( $selectedInput.data( 'checked' ) ) {
			$selectedInput.prop( 'checked', false ).trigger( 'change' );
		}
	},

	onRender: function() {
		ControlBaseItemView.prototype.onRender.apply( this, arguments );

		var currentValue = this.getControlValue();

		if ( currentValue ) {
			this.ui.inputs.filter( '[value="' + currentValue + '"]' ).prop( 'checked', true );
		} else if ( ! this.model.get( 'toggle' ) ) {
			this.ui.inputs.first().prop( 'checked', true ).trigger( 'change' );
		}
	}
} );

module.exports = ControlChooseItemView;

},{"elementor-views/controls/base":74}],77:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlColorItemView;

ControlColorItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.picker = '.color-picker-hex';

		return ui;
	},

	onReady: function() {
		elementor.helpers.wpColorPicker( this.ui.picker, {
			change: _.bind( function() {
				this.setValue( this.ui.picker.wpColorPicker( 'color' ) );
			}, this ),

			clear: _.bind( function() {
				this.setValue( '' );
			}, this ),

			width: 251
		} ).wpColorPicker( 'instance' )
			.wrap.find( '> .wp-picker-input-wrap > .wp-color-picker' )
			.removeAttr( 'maxlength' );
	},

	onBeforeDestroy: function() {
		if ( this.ui.picker.wpColorPicker( 'instance' ) ) {
			this.ui.picker.wpColorPicker( 'close' );
		}
		this.$el.remove();
	}
} );

module.exports = ControlColorItemView;

},{"elementor-views/controls/base":74}],78:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlDateTimePickerItemView;

ControlDateTimePickerItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.picker = '.elementor-date-time-picker';

		return ui;
	},

	onReady: function() {
		var self = this;

		var options = {
			onHide: function() {
				self.saveValue();
			}
		};

		this.ui.picker.appendDtpicker( options ).handleDtpicker( 'setDate', new Date( this.getControlValue() * 1000 ) );
	},

	saveValue: function() {
		var date = this.ui.picker.handleDtpicker( 'getDate' );
		this.setValue( date.getTime() / 1000 );
	},

	onBeforeDestroy: function() {
		this.saveValue();
		this.ui.picker.dtpicker( 'destroy' );
	}
} );

module.exports = ControlDateTimePickerItemView;

},{"elementor-views/controls/base":74}],79:[function(require,module,exports){
var ControlBaseUnitsItemView = require( 'elementor-views/controls/base-units' ),
	ControlDimensionsItemView;

ControlDimensionsItemView = ControlBaseUnitsItemView.extend( {
	ui: function() {
		var ui = ControlBaseUnitsItemView.prototype.ui.apply( this, arguments );

		ui.controls = '.elementor-control-dimension > input:enabled';
		ui.link = 'button.elementor-link-dimensions';

		return ui;
	},

	childEvents: {
		'click @ui.link': 'onLinkDimensionsClicked'
	},

	defaultDimensionValue: 0,

	initialize: function() {
		ControlBaseUnitsItemView.prototype.initialize.apply( this, arguments );

		// TODO: Need to be in helpers, and not in variable
		this.model.set( 'allowed_dimensions', this.filterDimensions( this.model.get( 'allowed_dimensions' ) ) );
	},

	getPossibleDimensions: function() {
		return [
			'top',
			'right',
			'bottom',
			'left'
		];
	},

	filterDimensions: function( filter ) {
		filter = filter || 'all';

		var dimensions = this.getPossibleDimensions();

		if ( 'all' === filter ) {
			return dimensions;
		}

		if ( ! _.isArray( filter ) ) {
			if ( 'horizontal' === filter ) {
				filter = [ 'right', 'left' ];
			} else if ( 'vertical' === filter ) {
				filter = [ 'top', 'bottom' ];
			}
		}

		return filter;
	},

	onReady: function() {
		var currentValue = this.getControlValue();

		if ( ! this.isLinkedDimensions() ) {
			this.ui.link.addClass( 'unlinked' );

			this.ui.controls.each( _.bind( function( index, element ) {
				var value = currentValue[ element.dataset.setting ];

				if ( _.isEmpty( value ) ) {
					value = this.defaultDimensionValue;
				}

				this.$( element ).val( value );
			}, this ) );
		}

		this.fillEmptyDimensions();
	},

	updateDimensionsValue: function() {
		var currentValue = {},
			dimensions = this.getPossibleDimensions(),
			$controls = this.ui.controls;

		dimensions.forEach( _.bind( function( dimension ) {
			var $element = $controls.filter( '[data-setting="' + dimension + '"]' );

			currentValue[ dimension ] = $element.length ? $element.val() : this.defaultDimensionValue;
		}, this ) );

		this.setValue( currentValue );
	},

	fillEmptyDimensions: function() {
		var dimensions = this.getPossibleDimensions(),
			allowedDimensions = this.model.get( 'allowed_dimensions' ),
			$controls = this.ui.controls;

		if ( this.isLinkedDimensions() ) {
			return;
		}

		dimensions.forEach( _.bind( function( dimension ) {
			var $element = $controls.filter( '[data-setting="' + dimension + '"]' ),
				isAllowedDimension = -1 !== _.indexOf( allowedDimensions, dimension );

			if ( isAllowedDimension && $element.length && _.isEmpty( $element.val() ) ) {
				$element.val( this.defaultDimensionValue );
			}

		}, this ) );
	},

	updateDimensions: function() {
		this.fillEmptyDimensions();
		this.updateDimensionsValue();
	},

	resetDimensions: function() {
		this.ui.controls.val( '' );

		this.updateDimensionsValue();
	},

	onInputChange: function( event ) {
		var inputSetting = event.target.dataset.setting;

		if ( 'unit' === inputSetting ) {
			this.resetDimensions();
		}

		if ( ! _.contains( this.getPossibleDimensions(), inputSetting ) ) {
			return;
		}

		if ( this.isLinkedDimensions() ) {
			var $thisControl = this.$( event.target );

			this.ui.controls.val( $thisControl.val() );
		}

		this.updateDimensions();
	},

	onLinkDimensionsClicked: function( event ) {
		event.preventDefault();
		event.stopPropagation();

		this.ui.link.toggleClass( 'unlinked' );

		this.setValue( 'isLinked', ! this.ui.link.hasClass( 'unlinked' ) );

		if ( this.isLinkedDimensions() ) {
			// Set all controls value from the first control.
			this.ui.controls.val( this.ui.controls.eq( 0 ).val() );
		}

		this.updateDimensions();
	},

	isLinkedDimensions: function() {
		return this.getControlValue( 'isLinked' );
	}
} );

module.exports = ControlDimensionsItemView;

},{"elementor-views/controls/base-units":73}],80:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlFontItemView;

ControlFontItemView = ControlBaseItemView.extend( {
	onReady: function() {
		this.ui.select.select2( {
			dir: elementor.config.is_rtl ? 'rtl' : 'ltr'
		} );
	},

	templateHelpers: function() {
		var helpers = ControlBaseItemView.prototype.templateHelpers.apply( this, arguments );

		helpers.getFontsByGroups = _.bind( function( groups ) {
			var fonts = this.model.get( 'fonts' ),
				filteredFonts = {};

			_.each( fonts, function( fontType, fontName ) {
				if ( _.isArray( groups ) && _.contains( groups, fontType ) || fontType === groups ) {
					filteredFonts[ fontName ] = fontType;
				}
			} );

			return filteredFonts;
		}, this );

		return helpers;
	}
} );

module.exports = ControlFontItemView;

},{"elementor-views/controls/base":74}],82:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlIconItemView;

ControlIconItemView = ControlBaseItemView.extend( {

	initialize: function() {
		ControlBaseItemView.prototype.initialize.apply( this, arguments );

		this.filterIcons();
	},

	filterIcons: function() {
		var icons = this.model.get( 'icons' ),
			include = this.model.get( 'include' ),
			exclude = this.model.get( 'exclude' );

		if ( include ) {
			var filteredIcons = {};

			_.each( include, function( iconKey ) {
				filteredIcons[ iconKey ] = icons[ iconKey ];
			} );

			this.model.set( 'icons', filteredIcons );
			return;
		}

		if ( exclude ) {
			_.each( exclude, function( iconKey ) {
				delete icons[ iconKey ];
			} );
		}
	},

	iconsList: function( icon ) {
		if ( ! icon.id ) {
			return icon.text;
		}

		return Backbone.$(
			'<span><i class="' + icon.id + '"></i> ' + icon.text + '</span>'
		);
	},

	onReady: function() {
		this.ui.select.select2( {
			allowClear: true,
			templateResult: _.bind( this.iconsList, this ),
			templateSelection: _.bind( this.iconsList, this )
		} );
	}
} );

module.exports = ControlIconItemView;

},{"elementor-views/controls/base":74}],83:[function(require,module,exports){
var ControlMultipleBaseItemView = require( 'elementor-views/controls/base-multiple' ),
	ControlImageDimensionsItemView;

ControlImageDimensionsItemView = ControlMultipleBaseItemView.extend( {
	ui: function() {
		return {
			inputWidth: 'input[data-setting="width"]',
			inputHeight: 'input[data-setting="height"]',

			btnApply: 'button.elementor-image-dimensions-apply-button'
		};
	},

	// Override the base events
	baseEvents: {
		'click @ui.btnApply': 'onApplyClicked'
	},

	onApplyClicked: function( event ) {
		event.preventDefault();

		this.setValue( {
			width: this.ui.inputWidth.val(),
			height: this.ui.inputHeight.val()
		} );
	}
} );

module.exports = ControlImageDimensionsItemView;

},{"elementor-views/controls/base-multiple":72}],84:[function(require,module,exports){
var ControlMultipleBaseItemView = require( 'elementor-views/controls/base-multiple' ),
	ControlMediaItemView;

ControlMediaItemView = ControlMultipleBaseItemView.extend( {
	ui: function() {
		var ui = ControlMultipleBaseItemView.prototype.ui.apply( this, arguments );

		ui.controlMedia = '.elementor-control-media';
		ui.frameOpeners = '.elementor-control-media-upload-button, .elementor-control-media-image';
		ui.altButton = '.elementor-control-media-alt';
		ui.titleButton = '.elementor-control-media-title';
		ui.deleteButton = '.elementor-control-media-delete';
		ui.urlButton = '.elementor-control-media-url';
		ui.urlField = '#elementor-control-media-url-' + this.model.cid;

		return ui;
	},

	childEvents: {
		'click @ui.frameOpeners': 'openFrame',
		'click @ui.altButton': 'setImageAlt',
		'click @ui.titleButton': 'setImageTitle',
		'click @ui.deleteButton': 'deleteImage',
		'click @ui.urlButton': 'setImageUrl',
		'input @ui.urlField': 'select'
	},

	onReady: function() {
		if ( _.isEmpty( this.getControlValue( 'url' ) ) ) {
			this.ui.controlMedia.addClass( 'media-empty' );
		}
	},

	openFrame: function() {
		openPsFileManager( 'elementor-control-media-url-' + this.model.cid );
	},

	setImageUrl: function() {
		var url = this.getControlValue().url;
		url = prompt( 'URL:', decodeURI( (/^(https?:)?\/\//i.test( url ) ? '' : elementor.config.home_url) + url ) );
		if (url !== null) {
			this.ui.urlField.val( url );
			this.select();
		}
	},

	setImageAlt: function() {
		var alt = prompt( 'Alt:', this.getControlValue().alt );
		if (alt !== null) {
			this.setValue( { alt: alt } );
		}
	},

	setImageTitle: function() {
		var title = prompt( 'Title:', this.getControlValue().title );
		if (title !== null) {
			this.setValue( { title: title } );
		}
	},

	deleteImage: function() {
		this.setValue( {
			url: '',
			id: '',
			alt: '',
			title: ''
		} );

		this.render();
	},

	select: function() {
		var attachment = this.ui.urlField.val();

		if ( ! attachment.indexOf( elementor.config.home_url ) ) {
			attachment = attachment.substr( elementor.config.home_url.length );
			this.ui.urlField.val( attachment );
		}

		this.setValue( {
			url: encodeURI( attachment ),
			id: 0
		} );

		this.render();
	},

	onBeforeDestroy: function() {
		this.$el.remove();
	}
} );

module.exports = ControlMediaItemView;

},{"elementor-views/controls/base-multiple":72}],85:[function(require,module,exports){
var ControlMultipleBaseItemView = require( 'elementor-views/controls/base-multiple' ),
	ControlOrderItemView;

ControlOrderItemView = ControlMultipleBaseItemView.extend( {
	ui: function() {
		var ui = ControlMultipleBaseItemView.prototype.ui.apply( this, arguments );

		ui.reverseOrderLabel = '.elementor-control-order-label';

		return ui;
	},

	changeLabelTitle: function() {
		var reverseOrder = this.getControlValue( 'reverse_order' );

		this.ui.reverseOrderLabel.attr( 'title', elementor.translate( reverseOrder ? 'asc' : 'desc' ) );
	},

	onRender: function() {
		ControlMultipleBaseItemView.prototype.onRender.apply( this, arguments );

		this.changeLabelTitle();
	},

	onInputChange: function() {
		this.changeLabelTitle();
	}
} );

module.exports = ControlOrderItemView;

},{"elementor-views/controls/base-multiple":72}],86:[function(require,module,exports){
var RepeaterRowView;

RepeaterRowView = Marionette.CompositeView.extend( {
	template: Marionette.TemplateCache.get( '#tmpl-elementor-repeater-row' ),

	className: 'repeater-fields',

	ui: {
		duplicateButton: '.elementor-repeater-tool-duplicate',
		editButton: '.elementor-repeater-tool-edit',
		removeButton: '.elementor-repeater-tool-remove',
		itemTitle: '.elementor-repeater-row-item-title'
	},

	behaviors: {
		HandleInnerTabs: {
			behaviorClass: require( 'elementor-behaviors/inner-tabs' )
		}
	},

	triggers: {
		'click @ui.removeButton': 'click:remove',
		'click @ui.duplicateButton': 'click:duplicate',
		'click @ui.itemTitle': 'click:edit'
	},

	templateHelpers: function() {
		return {
			itemIndex: this.getOption( 'itemIndex' )
		};
	},

	childViewContainer: '.elementor-repeater-row-controls',

	getChildView: function( item ) {
		var controlType = item.get( 'type' );

		return elementor.getControlItemView( controlType );
	},

	childViewOptions: function() {
		return {
			elementSettingsModel: this.model
		};
	},

	checkConditions: function() {
		var self = this;

		self.collection.each( function( model ) {
			var conditions = model.get( 'conditions' ),
				parentConditions = model.get( 'parent_conditions' ),
				isVisible = true;

			if ( conditions ) {
				isVisible = elementor.conditions.check( conditions, self.model.attributes );
			}

			if ( parentConditions ) {
				isVisible = elementor.conditions.check( parentConditions, self.getOption( 'parentModel' ).attributes );
			}

			var child = self.children.findByModelCid( model.cid );

			child.$el.toggle( isVisible );
		} );
	},

	updateIndex: function( newIndex ) {
		this.itemIndex = newIndex;
		this.setTitle();
	},

	setTitle: function() {
		var self = this,
			titleField = self.getOption( 'titleField' ),
			title = '';

		if ( titleField ) {
			var values = {};

			self.children.each( function( child ) {
				values[ child.model.get( 'name' ) ] = child.getControlValue();
			} );

			title = Marionette.TemplateCache.prototype.compileTemplate( titleField )( values );
		}

		if ( ! title ) {
			title = elementor.translate( 'Item #{0}', [ self.getOption( 'itemIndex' ) ] );
		}

		self.ui.itemTitle.html( title );
	},

	initialize: function( options ) {
		var self = this;

		self.elementSettingsModel = options.elementSettingsModel;

		self.itemIndex = 0;

		// Collection for Controls list
		self.collection = new Backbone.Collection( options.controlFields );

		self.listenTo( self.model, 'change', self.checkConditions );
		self.listenTo( self.getOption( 'parentModel' ), 'change', self.checkConditions );

		if ( options.titleField ) {
			self.listenTo( self.model, 'change', self.setTitle );
		}
	},

	onRender: function() {
		this.setTitle();
		this.checkConditions();
	}
} );

module.exports = RepeaterRowView;

},{"elementor-behaviors/inner-tabs":4}],87:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	RepeaterRowView = require( 'elementor-views/controls/repeater-row' ),
	ControlRepeaterItemView;

ControlRepeaterItemView = ControlBaseItemView.extend( {
	ui: {
		btnAddRow: '.elementor-repeater-add',
		fieldContainer: '.elementor-repeater-fields'
	},

	events: {
		'click @ui.btnAddRow': 'onButtonAddRowClick',
		'sortstart @ui.fieldContainer': 'onSortStart',
		'sortupdate @ui.fieldContainer': 'onSortUpdate',
		'sortstop @ui.fieldContainer': 'onSortStop'
	},

	childView: RepeaterRowView,

	childViewContainer: '.elementor-repeater-fields',

	templateHelpers: function() {
		return {
			data: _.extend( {}, this.model.toJSON(), { controlValue: [] } )
		};
	},

	childViewOptions: function() {
		return {
			controlFields: this.model.get( 'fields' ),
			titleField: this.model.get( 'title_field' ),
			parentModel: this.elementSettingsModel // For parentConditions in repeaterRow
		};
	},

	initialize: function( options ) {
		ControlBaseItemView.prototype.initialize.apply( this, arguments );

		this.collection = this.elementSettingsModel.get( this.model.get( 'name' ) );

		this.listenTo( this.collection, 'change add remove reset', this.onCollectionChanged, this );

		this.collection.each( function( model ) {
			if ( ! model.get( '_id' ) ) {
				model.set( '_id', elementor.helpers.getUniqueID() );
			}
		} );
	},

	addRow: function( data, options ) {
		var id = elementor.helpers.getUniqueID();

		if ( data instanceof Backbone.Model ) {
			data.set( '_id', id );
		} else {
			data._id = id;
		}

		return this.collection.add( data, options );
	},

	editRow: function( rowView ) {
		if ( this.currentEditableChild ) {
			var currentEditable = this.currentEditableChild.getChildViewContainer( this.currentEditableChild );
			currentEditable.removeClass( 'editable' );

			// If the repeater contains TinyMCE editors, fire the `hide` trigger to hide floated toolbars
			currentEditable.find( '.elementor-wp-editor' ).each( function() {
				tinymce.get( this.id ).fire( 'hide' );
			} );
		}

		if ( this.currentEditableChild === rowView ) {
			delete this.currentEditableChild;
			return;
		}

		rowView.getChildViewContainer( rowView ).addClass( 'editable' );

		this.currentEditableChild = rowView;

		this.updateActiveRow();
	},

	toggleMinRowsClass: function() {
		if ( ! this.model.get( 'prevent_empty' ) ) {
			return;
		}

		this.$el.toggleClass( 'elementor-repeater-has-minimum-rows', 1 >= this.collection.length );
	},

	updateActiveRow: function() {
		var activeItemIndex = 0;

		if ( this.currentEditableChild ) {
			activeItemIndex = this.currentEditableChild.itemIndex;
		}

		this.setEditSetting( 'activeItemIndex', activeItemIndex );
	},

	updateChildIndexes: function() {
		this.children.each( _.bind( function( view ) {
			view.updateIndex( this.collection.indexOf( view.model ) + 1 );
		}, this ) );
	},

	onRender: function() {
		this.ui.fieldContainer.sortable( {
			axis: 'y',
			distance: 5,
			handle: '.elementor-repeater-row-tools'
		} );

		this.toggleMinRowsClass();
	},

	onSortStart: function( event, ui ) {
		ui.item.data( 'oldIndex', ui.item.index() );
	},

	onSortStop: function( event, ui ) {
		// Reload TinyMCE editors (if exist), it's a bug that TinyMCE content is missing after stop dragging
		ui.item.find( '.elementor-wp-editor' ).each( function() {
			var editor = tinymce.get( this.id ),
				settings = editor.settings;

			settings.height = Backbone.$( editor.getContainer() ).height();
			tinymce.execCommand( 'mceRemoveEditor', true, this.id );
			tinymce.init( settings );
		} );
	},

	onSortUpdate: function( event, ui ) {
		var oldIndex = ui.item.data( 'oldIndex' ),
			model = this.collection.at( oldIndex ),
			newIndex = ui.item.index();

		this.collection.remove( model );

		this.addRow( model, { at: newIndex } );
	},

	onAddChild: function() {
		this.updateChildIndexes();
		this.updateActiveRow();
	},

	onRemoveChild: function( childView ) {
		if ( childView === this.currentEditableChild ) {
			delete this.currentEditableChild;
		}

		this.updateChildIndexes();
		this.updateActiveRow();
	},

	onCollectionChanged: function() {
		this.elementSettingsModel.trigger( 'change' );

		this.toggleMinRowsClass();
	},

	onButtonAddRowClick: function() {
		var defaults = {};
		_.each( this.model.get( 'fields' ), function( field ) {
			defaults[ field.name ] = field['default'];
		} );

		var newModel = this.addRow( defaults ),
			newChildView = this.children.findByModel( newModel );

		this.editRow( newChildView );
	},

	onChildviewClickRemove: function( childView ) {
		childView.model.destroy();
	},

	onChildviewClickDuplicate: function( childView ) {
		this.addRow( childView.model.clone(), { at: childView.itemIndex } );
	},

	onChildviewClickEdit: function( childView ) {
		this.editRow( childView );
	}
} );

module.exports = ControlRepeaterItemView;

},{"elementor-views/controls/base":74,"elementor-views/controls/repeater-row":86}],88:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlSectionItemView;

ControlSectionItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.heading = '.elementor-panel-heading';

		return ui;
	},

	triggers: {
		'click': 'control:section:clicked'
	}
} );

module.exports = ControlSectionItemView;

},{"elementor-views/controls/base":74}],89:[function(require,module,exports){
// Attention: DO NOT use this control since it has bugs
// TODO: This control is unused
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlSelect2ItemView;

ControlSelect2ItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.select = '.elementor-select2';

		return ui;
	},

	onReady: function() {
		var options = {
			allowClear: true
		};

		this.ui.select.select2( options );
	},

	onBeforeDestroy: function() {
		if ( this.ui.select.data( 'select2' ) ) {
			this.ui.select.select2( 'destroy' );
		}
		this.$el.remove();
	}
} );

module.exports = ControlSelect2ItemView;

},{"elementor-views/controls/base":74}],90:[function(require,module,exports){
var ControlBaseUnitsItemView = require( 'elementor-views/controls/base-units' ),
	ControlSliderItemView;

ControlSliderItemView = ControlBaseUnitsItemView.extend( {
	ui: function() {
		var ui = ControlBaseUnitsItemView.prototype.ui.apply( this, arguments );

		ui.slider = '.elementor-slider';

		return ui;
	},

	childEvents: {
		'slide @ui.slider': 'onSlideChange'
	},

	initSlider: function() {
		var size = this.getControlValue( 'size' ),
			unitRange = this.getCurrentRange();

		this.ui.input.attr( unitRange ).val( size );

		this.ui.slider.slider( _.extend( {}, unitRange, { value: size } ) );
	},

	resetSize: function() {
		this.setValue( 'size', '' );

		this.initSlider();
	},

	onReady: function() {
		this.initSlider();
	},

	onSlideChange: function( event, ui ) {
		this.setValue( 'size', ui.value );

		this.ui.input.val( ui.value );
	},

	onInputChange: function( event ) {
		var dataChanged = event.currentTarget.dataset.setting;

		if ( 'size' === dataChanged ) {
			this.ui.slider.slider( 'value', this.getControlValue( 'size' ) );
		} else if ( 'unit' === dataChanged ) {
			this.resetSize();
		}
	},

	onBeforeDestroy: function() {
		this.ui.slider.slider( 'destroy' );
		this.$el.remove();
	}
} );

module.exports = ControlSliderItemView;

},{"elementor-views/controls/base-units":73}],91:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlStructureItemView;

ControlStructureItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.resetStructure = '.elementor-control-structure-reset';

		return ui;
	},

	childEvents: {
		'click @ui.resetStructure': 'onResetStructureClick'
	},

	templateHelpers: function() {
		var helpers = ControlBaseItemView.prototype.templateHelpers.apply( this, arguments );

		helpers.getMorePresets = _.bind( this.getMorePresets, this );

		return helpers;
	},

	getCurrentEditedSection: function() {
		var editor = elementor.getPanelView().getCurrentPageView();

		return editor.getOption( 'editedElementView' );
	},

	getMorePresets: function() {
		var parsedStructure = elementor.presetsFactory.getParsedStructure( this.getControlValue() );

		return elementor.presetsFactory.getPresets( parsedStructure.columnsCount );
	},

	onInputChange: function() {
		this.getCurrentEditedSection().redefineLayout();

		this.render();
	},

	onResetStructureClick: function() {
		this.getCurrentEditedSection().resetColumnsCustomSize();
	}
} );

module.exports = ControlStructureItemView;

},{"elementor-views/controls/base":74}],92:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlTabItemView;

ControlTabItemView = ControlBaseItemView.extend( {
	triggers: {
		'click': 'control:tab:clicked'
	}
} );

module.exports = ControlTabItemView;

},{"elementor-views/controls/base":74}],93:[function(require,module,exports){
var ControlMultipleBaseItemView = require( 'elementor-views/controls/base-multiple' ),
	ControlUrlItemView;

ControlUrlItemView = ControlMultipleBaseItemView.extend( {
	ui: function() {
		var ui = ControlMultipleBaseItemView.prototype.ui.apply( this, arguments );

		ui.btnExternal = 'button.elementor-control-url-target';

		return ui;
	},

	// Override the base events
	childEvents: {
		'click @ui.btnExternal': 'onExternalClicked'
	},

	onReady: function() {
		if ( this.getControlValue( 'is_external' ) ) {
			this.ui.btnExternal.addClass( 'active' );
		}
	},

	onExternalClicked: function( event ) {
		event.preventDefault();

		this.ui.btnExternal.toggleClass( 'active' );
		this.setValue( 'is_external', this.isExternal() );
	},

	isExternal: function() {
		return this.ui.btnExternal.hasClass( 'active' );
	}
} );

module.exports = ControlUrlItemView;

},{"elementor-views/controls/base-multiple":72}],94:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlWPWidgetItemView;

ControlWPWidgetItemView = ControlBaseItemView.extend( {
	ui: function() {
		var ui = ControlBaseItemView.prototype.ui.apply( this, arguments );

		ui.form = 'form';
		ui.loading = '.wp-widget-form-loading';

		return ui;
	},

	events: {
		'keyup @ui.form :input': 'onFormChanged',
		'change @ui.form :input': 'onFormChanged'
	},

	onFormChanged: function() {
		var idBase = 'widget-' + this.model.get( 'id_base' ),
			settings = this.ui.form.elementorSerializeObject()[ idBase ].REPLACE_TO_ID;

		this.setValue( settings );
	},

	onReady: function() {
		elementor.ajax.send( 'editorGetPsWidgetForm', {
			data: {
				widget_type: this.model.get( 'widget' ),
				data: JSON.stringify( this.elementSettingsModel.toJSON() )
			},
			success: _.bind( function( data ) {
				this.ui.form.html( data );
			}, this )
		} );
	}
} );

module.exports = ControlWPWidgetItemView;

},{"elementor-views/controls/base":74}],95:[function(require,module,exports){
var ControlBaseItemView = require( 'elementor-views/controls/base' ),
	ControlWysiwygItemView;

ControlWysiwygItemView = ControlBaseItemView.extend( {

	childEvents: {
		'keyup textarea.elementor-wp-editor': 'updateElementModel'
	},

	initialize: function() {
		ControlBaseItemView.prototype.initialize.apply( this, arguments );
		this.editorID = 'elementorwpeditor' + this.cid;
	},

	attachElContent: function() {
		var tpl = '<div class="html-active" id="tinymce-editor-wrap"><div class="wp-editor-container" id="tinymce-editor-container"><textarea class="elementor-wp-editor" cols="40" id="tinymce-editor" name="tinymce-editor" rows="15">{{CONTENT}}</textarea></div></div>';
		var editorTemplate = tpl.replace( /tinymce-editor/g, this.editorID ).replace( '{{CONTENT}}', this.getControlValue() );

		this.$el.html( editorTemplate );

		return this;
	},

	onShow: function() {
		tinymce.EditorManager.execCommand('mceAddEditor', false, this.editorID);
	},

	onBeforeDestroy: function() {
		tinymce.EditorManager.execCommand( 'mceRemoveEditor', true, this.editorID);
	}
} );

module.exports = ControlWysiwygItemView;

},{"elementor-views/controls/base":74}],96:[function(require,module,exports){
var ElementEmptyView;

ElementEmptyView = Marionette.ItemView.extend( {
	template: '#tmpl-elementor-empty-preview',

	className: 'elementor-empty-view',

	events: {
		'click': 'onClickAdd'
	},

	onClickAdd: function() {
		elementor.getPanelView().setPage( 'elements' );
	}
} );

module.exports = ElementEmptyView;

},{}],97:[function(require,module,exports){
var BaseSectionsContainerView = require( 'elementor-views/base-sections-container' ),
	Preview;

Preview = BaseSectionsContainerView.extend( {
	template: Marionette.TemplateCache.get( '#tmpl-elementor-preview' ),

	id: 'elementor-inner',

	childViewContainer: '#elementor-section-wrap',

	ui: {
		addSectionArea: '#elementor-add-section',
		addNewSection: '#elementor-add-new-section',
		closePresetsIcon: '#elementor-select-preset-close',
		addSectionButton: '#elementor-add-section-button',
		addTemplateButton: '#elementor-add-template-button',
		selectPreset: '#elementor-select-preset',
		presets: '.elementor-preset'
	},

	events: {
		'click @ui.addSectionButton': 'onAddSectionButtonClick',
		'click @ui.addTemplateButton': 'onAddTemplateButtonClick',
		'click @ui.closePresetsIcon': 'closeSelectPresets',
		'click @ui.presets': 'onPresetSelected'
	},

	closeSelectPresets: function() {
		this.ui.addNewSection.show();
		this.ui.selectPreset.hide();
	},

	fixBlankPageOffset: function() {
		var sectionHandleHeight = 27,
			elTopOffset = this.$el.offset().top,
			elTopOffsetRange = sectionHandleHeight - elTopOffset;

		if ( 0 < elTopOffsetRange ) {
			var $style = Backbone.$( '<style>' ).text( '.elementor-editor-active #elementor-inner{margin-top: ' + elTopOffsetRange + 'px}' );

			elementor.$previewContents.children().children( 'head' ).append( $style );
		}
	},

	onAddSectionButtonClick: function() {
		this.ui.addNewSection.hide();
		this.ui.selectPreset.show();
	},

	onAddTemplateButtonClick: function() {
		elementor.templates.startModal( function() {
			elementor.templates.showTemplates();
		} );
	},

	onRender: function() {
		var self = this;

		self.ui.addSectionArea.html5Droppable( {
			axis: [ 'vertical' ],
			groups: [ 'elementor-element' ],
			onDragEnter: function( side ) {
				self.ui.addSectionArea.attr( 'data-side', side );
			},
			onDragLeave: function() {
				self.ui.addSectionArea.removeAttr( 'data-side' );
			},
			onDropping: function() {
				var elementView = elementor.channels.panelElements.request( 'element:selected' ),
					newSection = self.addSection(),
					elType = elementView.model.get( 'elType' );

				var elementData = {
					id: elementor.helpers.getUniqueID(),
					elType: elType
				};

				if ( 'widget' === elType ) {
					elementData.widgetType = elementView.model.get( 'widgetType' );
				} else {
					elementData.elements = [];
					elementData.isInner = true;
				}

				newSection.triggerMethod( 'request:add', elementData );
			}
		} );

		_.defer( _.bind( self.fixBlankPageOffset, this ) );
	},

	onPresetSelected: function( event ) {
		this.closeSelectPresets();

		var selectedStructure = event.currentTarget.dataset.structure,
			parsedStructure = elementor.presetsFactory.getParsedStructure( selectedStructure ),
			elements = [],
			loopIndex;

		for ( loopIndex = 0; loopIndex < parsedStructure.columnsCount; loopIndex++ ) {
			elements.push( {
				id: elementor.helpers.getUniqueID(),
				elType: 'column',
				settings: {},
				elements: []
			} );
		}

		var newSection = this.addSection( { elements: elements } );

		newSection.setStructure( selectedStructure );
		newSection.redefineLayout();
	}
} );

module.exports = Preview;

},{"elementor-views/base-sections-container":69}],98:[function(require,module,exports){
var BaseElementView = require( 'elementor-views/base-element' ),
	ColumnView = require( 'elementor-views/column' ),
	SectionView;

SectionView = BaseElementView.extend( {
	template: Marionette.TemplateCache.get( '#tmpl-elementor-element-section-content' ),

	childView: ColumnView,

	className: function() {
		var classes = 'elementor-section',
			type = this.isInner() ? 'inner' : 'top';

		classes += ' elementor-' + type + '-section';

		return classes;
	},

	tagName: 'section',

	childViewContainer: '> .elementor-container > .elementor-row',

	behaviors: {
		Sortable: {
			behaviorClass: require( 'elementor-behaviors/sortable' ),
			elChildType: 'column'
		},
		HandleDuplicate: {
			behaviorClass: require( 'elementor-behaviors/handle-duplicate' )
		},
		HandleAddMode: {
			behaviorClass: require( 'elementor-behaviors/duplicate' )
		},
		HandleElementsRelation: {
			behaviorClass: require( 'elementor-behaviors/elements-relation' )
		}
	},

	ui: function() {
		var ui = BaseElementView.prototype.ui.apply( this, arguments );

		ui.duplicateButton = '.elementor-editor-section-settings-list .elementor-editor-element-duplicate';
		ui.removeButton = '.elementor-editor-section-settings-list .elementor-editor-element-remove';
		ui.saveButton = '.elementor-editor-section-settings-list .elementor-editor-element-save';
		ui.triggerButton = '.elementor-editor-section-settings-list .elementor-editor-element-trigger';

		return ui;
	},

	events: function() {
		var events = BaseElementView.prototype.events.apply( this, arguments );

		events[ 'click @ui.triggerButton' ] = 'onClickEdit';

		return events;
	},

	initialize: function() {
		BaseElementView.prototype.initialize.apply( this, arguments );

		this.listenTo( this.collection, 'add remove reset', this._checkIsFull );
		this.listenTo( this.collection, 'remove', this.onCollectionRemove );
		this.listenTo( this.model, 'change:settings:structure', this.onStructureChanged );
	},

	addEmptyColumn: function() {
		this.addChildModel( {
			id: elementor.helpers.getUniqueID(),
			elType: 'column',
			settings: {},
			elements: []
		} );
	},

	addChildModel: function( model, options ) {
		var isModelInstance = model instanceof Backbone.Model,
			isInner = this.isInner();

		if ( isModelInstance ) {
			model.set( 'isInner', isInner );
		} else {
			model.isInner = isInner;
		}

		return BaseElementView.prototype.addChildModel.apply( this, arguments );
	},

	getSortableOptions: function() {
		var sectionConnectClass = this.isInner() ? '.elementor-inner-section' : '.elementor-top-section';

		return {
			connectWith: sectionConnectClass + ' > .elementor-container > .elementor-row',
			handle: '> .elementor-element-overlay .elementor-editor-column-settings-list .elementor-editor-element-trigger',
			items: '> .elementor-column'
		};
	},

	getColumnPercentSize: function( element, size ) {
		return size / element.parent().width() * 100;
	},

	getDefaultStructure: function() {
		return this.collection.length + '0';
	},

	getStructure: function() {
		return this.model.getSetting( 'structure' );
	},

	setStructure: function( structure ) {
		var parsedStructure = elementor.presetsFactory.getParsedStructure( structure );

		if ( +parsedStructure.columnsCount !== this.collection.length ) {
			throw new TypeError( 'The provided structure doesn\'t match the columns count.' );
		}

		this.model.setSetting( 'structure', structure, true );
	},

	redefineLayout: function() {
		var preset = elementor.presetsFactory.getPresetByStructure( this.getStructure() );

		this.collection.each( function( model, index ) {
			model.setSetting( '_column_size', preset.preset[ index ] );
			model.setSetting( '_inline_size', null );
		} );

		this.children.invoke( 'changeSizeUI' );
	},

	resetLayout: function() {
		this.setStructure( this.getDefaultStructure() );
	},

	resetColumnsCustomSize: function() {
		this.collection.each( function( model ) {
			model.setSetting( '_inline_size', null );
		} );

		this.children.invoke( 'changeSizeUI' );
	},

	isCollectionFilled: function() {
		var MAX_SIZE = 10,
			columnsCount = this.collection.length;

		return ( MAX_SIZE <= columnsCount );
	},

	_checkIsFull: function() {
		this.$el.toggleClass( 'elementor-section-filled', this.isCollectionFilled() );
	},

	_checkIsEmpty: function() {
		if ( ! this.collection.length ) {
			this.addEmptyColumn();
		}
	},

	getNextColumn: function( columnView ) {
		var modelIndex = this.collection.indexOf( columnView.model ),
			nextModel = this.collection.at( modelIndex + 1 );

		return this.children.findByModelCid( nextModel.cid );
	},

	onBeforeRender: function() {
		this._checkIsEmpty();
	},

	onRender: function() {
		this._checkIsFull();
	},

	onAddChild: function() {
		if ( ! this.isBuffering ) {
			// Reset the layout just when we have really add/remove element.
			this.resetLayout();
		}
	},

	onCollectionRemove: function() {
		// If it's the last column, please create new one.
		this._checkIsEmpty();

		this.resetLayout();
	},

	onChildviewRequestResizeStart: function( childView ) {
		var nextChildView = this.getNextColumn( childView );

		if ( ! nextChildView ) {
			return;
		}

		var $iframes = childView.$el.find( 'iframe' ).add( nextChildView.$el.find( 'iframe' ) );

		elementor.helpers.disableElementEvents( $iframes );
	},

	onChildviewRequestResizeStop: function( childView ) {
		var nextChildView = this.getNextColumn( childView );

		if ( ! nextChildView ) {
			return;
		}

		var $iframes = childView.$el.find( 'iframe' ).add( nextChildView.$el.find( 'iframe' ) );

		elementor.helpers.enableElementEvents( $iframes );
	},

	onChildviewRequestResize: function( childView, ui ) {
		// Get current column details
		var currentSize = childView.model.getSetting( '_inline_size' );

		if ( ! currentSize ) {
			currentSize = this.getColumnPercentSize( ui.element, ui.originalSize.width );
		}

		var newSize = this.getColumnPercentSize( ui.element, ui.size.width ),
			difference = newSize - currentSize;

		ui.element.css( {
			//width: currentSize + '%',
			width: '',
			left: 'initial' // Fix for RTL resizing
		} );

		// Get next column details
		var nextChildView = this.getNextColumn( childView );

		if ( ! nextChildView ) {
			return;
		}

		var MINIMUM_COLUMN_SIZE = 10,

			$nextElement = nextChildView.$el,
			nextElementCurrentSize = this.getColumnPercentSize( $nextElement, $nextElement.width() ),
			nextElementNewSize = nextElementCurrentSize - difference;

		if ( newSize < MINIMUM_COLUMN_SIZE || newSize > 100 || ! difference || nextElementNewSize < MINIMUM_COLUMN_SIZE || nextElementNewSize > 100 ) {
			return;
		}

		// Set the current column size
		childView.model.setSetting( '_inline_size', newSize.toFixed( 3 ) );
		childView.changeSizeUI();

		// Set the next column size
		nextChildView.model.setSetting( '_inline_size', nextElementNewSize.toFixed( 3 ) );
		nextChildView.changeSizeUI();
	},

	onStructureChanged: function() {
		this.redefineLayout();
	}
} );

module.exports = SectionView;

},{"elementor-behaviors/duplicate":1,"elementor-behaviors/elements-relation":2,"elementor-behaviors/handle-duplicate":3,"elementor-behaviors/sortable":6,"elementor-views/base-element":68,"elementor-views/column":70}],99:[function(require,module,exports){
var BaseElementView = require( 'elementor-views/base-element' ),
	WidgetView;

WidgetView = BaseElementView.extend( {
	_templateType: null,

	getTemplate: function() {
		var editModel = this.getEditModel();

		if ( 'remote' !== this.getTemplateType() ) {
			return Marionette.TemplateCache.get( '#tmpl-elementor-' + editModel.get( 'elType' ) + '-' + editModel.get( 'widgetType' ) + '-content' );
		} else {
			return _.template( '' );
		}
	},

	className: function() {
		return 'elementor-widget';
	},

	modelEvents: {
		'before:remote:render': 'onModelBeforeRemoteRender',
		'remote:render': 'onModelRemoteRender'
	},

	events: function() {
		var events = BaseElementView.prototype.events.apply( this, arguments );

		events.click = 'onClickEdit';

		return events;
	},

	initialize: function() {
		BaseElementView.prototype.initialize.apply( this, arguments );

		var editModel = this.getEditModel();

		if ( ! editModel.getHtmlCache() ) {
			editModel.renderRemoteServer();
		}
	},

	getTemplateType: function() {
		if ( null === this._templateType ) {
			var editModel = this.getEditModel(),
				$template = Backbone.$( '#tmpl-elementor-' + editModel.get( 'elType' ) + '-' + editModel.get( 'widgetType' ) + '-content' );

			if ( 0 === $template.length ) {
				this._templateType = 'remote';
			} else {
				this._templateType = 'js';
			}
		}

		return this._templateType;
	},

	onModelBeforeRemoteRender: function() {
		this.$el.addClass( 'elementor-loading' );
	},

	onBeforeDestroy: function() {
		// Remove old style from the DOM.
		elementor.$previewContents.find( '#elementor-style-' + this.model.cid ).remove();
	},

	onModelRemoteRender: function() {
		if ( this.isDestroyed ) {
			return;
		}

		this.$el.removeClass( 'elementor-loading' );
		this.render();
	},

	attachElContent: function( html ) {
		var htmlCache = this.getEditModel().getHtmlCache();

		if ( htmlCache ) {
			html = htmlCache;
		}

		//this.$el.html( html );
		_.defer( _.bind( function() {
			elementorFrontend.getScopeWindow().jQuery( '#' + this.getElementUniqueID() ).html( html );
		}, this ) );

		return this;
	},

	onRender: function() {
		var self = this,
			editModel = self.getEditModel(),
			skinType = editModel.getSetting( '_skin' ) || 'default';

		self.$el
			.attr( 'data-element_type', editModel.get( 'widgetType' ) + '.' + skinType )
			.removeClass( 'elementor-widget-empty' )
			.addClass( 'elementor-widget-' + editModel.get( 'widgetType' ) )
			.addClass( 'elementor-widget-can-edit' )
			.children( '.elementor-widget-empty-icon' )
			.remove();

		self.$el.imagesLoaded().always( function() {

			setTimeout( function() {
				if ( 1 > self.$el.height() ) {
					self.$el.addClass( 'elementor-widget-empty' );

					// TODO: REMOVE THIS !!
					// TEMP CODING !!
					self.$el.append( '<i class="elementor-widget-empty-icon eicon-' + editModel.getIcon() + '"></i>' );
				}
			}, self.$el.hasClass('elementor-widget-instagram') ? 1200 : 200 );
			// Is element empty?
		} );
	}
} );

module.exports = WidgetView;

},{"elementor-views/base-element":68}],100:[function(require,module,exports){
'use strict';

/**
 * Handles managing all events for whatever you plug it into. Priorities for hooks are based on lowest to highest in
 * that, lowest priority hooks are fired first.
 */
var EventManager = function() {
	var slice = Array.prototype.slice,
		MethodsAvailable;

	/**
	 * Contains the hooks that get registered with this EventManager. The array for storage utilizes a "flat"
	 * object literal such that looking up the hook utilizes the native object literal hash.
	 */
	var STORAGE = {
		actions: {},
		filters: {}
	};

	/**
	 * Removes the specified hook by resetting the value of it.
	 *
	 * @param type Type of hook, either 'actions' or 'filters'
	 * @param hook The hook (namespace.identifier) to remove
	 *
	 * @private
	 */
	function _removeHook( type, hook, callback, context ) {
		var handlers, handler, i;

		if ( ! STORAGE[ type ][ hook ] ) {
			return;
		}
		if ( ! callback ) {
			STORAGE[ type ][ hook ] = [];
		} else {
			handlers = STORAGE[ type ][ hook ];
			if ( ! context ) {
				for ( i = handlers.length; i--; ) {
					if ( handlers[ i ].callback === callback ) {
						handlers.splice( i, 1 );
					}
				}
			} else {
				for ( i = handlers.length; i--; ) {
					handler = handlers[ i ];
					if ( handler.callback === callback && handler.context === context ) {
						handlers.splice( i, 1 );
					}
				}
			}
		}
	}

	/**
	 * Use an insert sort for keeping our hooks organized based on priority. This function is ridiculously faster
	 * than bubble sort, etc: http://jsperf.com/javascript-sort
	 *
	 * @param hooks The custom array containing all of the appropriate hooks to perform an insert sort on.
	 * @private
	 */
	function _hookInsertSort( hooks ) {
		var tmpHook, j, prevHook;
		for ( var i = 1, len = hooks.length; i < len; i++ ) {
			tmpHook = hooks[ i ];
			j = i;
			while ( ( prevHook = hooks[ j - 1 ] ) && prevHook.priority > tmpHook.priority ) {
				hooks[ j ] = hooks[ j - 1 ];
				--j;
			}
			hooks[ j ] = tmpHook;
		}

		return hooks;
	}

	/**
	 * Adds the hook to the appropriate storage container
	 *
	 * @param type 'actions' or 'filters'
	 * @param hook The hook (namespace.identifier) to add to our event manager
	 * @param callback The function that will be called when the hook is executed.
	 * @param priority The priority of this hook. Must be an integer.
	 * @param [context] A value to be used for this
	 * @private
	 */
	function _addHook( type, hook, callback, priority, context ) {
		var hookObject = {
			callback: callback,
			priority: priority,
			context: context
		};

		// Utilize 'prop itself' : http://jsperf.com/hasownproperty-vs-in-vs-undefined/19
		var hooks = STORAGE[ type ][ hook ];
		if ( hooks ) {
			hooks.push( hookObject );
			hooks = _hookInsertSort( hooks );
		} else {
			hooks = [ hookObject ];
		}

		STORAGE[ type ][ hook ] = hooks;
	}

	/**
	 * Runs the specified hook. If it is an action, the value is not modified but if it is a filter, it is.
	 *
	 * @param type 'actions' or 'filters'
	 * @param hook The hook ( namespace.identifier ) to be ran.
	 * @param args Arguments to pass to the action/filter. If it's a filter, args is actually a single parameter.
	 * @private
	 */
	function _runHook( type, hook, args ) {
		var handlers = STORAGE[ type ][ hook ], i, len;

		if ( ! handlers ) {
			return ( 'filters' === type ) ? args[ 0 ] : false;
		}

		len = handlers.length;
		if ( 'filters' === type ) {
			for ( i = 0; i < len; i++ ) {
				args[ 0 ] = handlers[ i ].callback.apply( handlers[ i ].context, args );
			}
		} else {
			for ( i = 0; i < len; i++ ) {
				handlers[ i ].callback.apply( handlers[ i ].context, args );
			}
		}

		return ( 'filters' === type ) ? args[ 0 ] : true;
	}

	/**
	 * Adds an action to the event manager.
	 *
	 * @param action Must contain namespace.identifier
	 * @param callback Must be a valid callback function before this action is added
	 * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
	 * @param [context] Supply a value to be used for this
	 */
	function addAction( action, callback, priority, context ) {
		if ( 'string' === typeof action && 'function' === typeof callback ) {
			priority = parseInt( ( priority || 10 ), 10 );
			_addHook( 'actions', action, callback, priority, context );
		}

		return MethodsAvailable;
	}

	/**
	 * Performs an action if it exists. You can pass as many arguments as you want to this function; the only rule is
	 * that the first argument must always be the action.
	 */
	function doAction( /* action, arg1, arg2, ... */ ) {
		var args = slice.call( arguments );
		var action = args.shift();

		if ( 'string' === typeof action ) {
			_runHook( 'actions', action, args );
		}

		return MethodsAvailable;
	}

	/**
	 * Removes the specified action if it contains a namespace.identifier & exists.
	 *
	 * @param action The action to remove
	 * @param [callback] Callback function to remove
	 */
	function removeAction( action, callback ) {
		if ( 'string' === typeof action ) {
			_removeHook( 'actions', action, callback );
		}

		return MethodsAvailable;
	}

	/**
	 * Adds a filter to the event manager.
	 *
	 * @param filter Must contain namespace.identifier
	 * @param callback Must be a valid callback function before this action is added
	 * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
	 * @param [context] Supply a value to be used for this
	 */
	function addFilter( filter, callback, priority, context ) {
		if ( 'string' === typeof filter && 'function' === typeof callback ) {
			priority = parseInt( ( priority || 10 ), 10 );
			_addHook( 'filters', filter, callback, priority, context );
		}

		return MethodsAvailable;
	}

	/**
	 * Performs a filter if it exists. You should only ever pass 1 argument to be filtered. The only rule is that
	 * the first argument must always be the filter.
	 */
	function applyFilters( /* filter, filtered arg, arg2, ... */ ) {
		var args = slice.call( arguments );
		var filter = args.shift();

		if ( 'string' === typeof filter ) {
			return _runHook( 'filters', filter, args );
		}

		return MethodsAvailable;
	}

	/**
	 * Removes the specified filter if it contains a namespace.identifier & exists.
	 *
	 * @param filter The action to remove
	 * @param [callback] Callback function to remove
	 */
	function removeFilter( filter, callback ) {
		if ( 'string' === typeof filter ) {
			_removeHook( 'filters', filter, callback );
		}

		return MethodsAvailable;
	}

	/**
	 * Maintain a reference to the object scope so our public methods never get confusing.
	 */
	MethodsAvailable = {
		removeFilter: removeFilter,
		applyFilters: applyFilters,
		addFilter: addFilter,
		removeAction: removeAction,
		doAction: doAction,
		addAction: addAction
	};

	// return all of the publicly available methods
	return MethodsAvailable;
};

module.exports = EventManager;

},{}]},{},[62,63,26]);
