/**
*	Site-specific configuration settings for Highslide JS
*/
hs.graphicsDir = '/highslide/graphics/';
hs.outlineType = 'custom';
hs.dimmingOpacity = 0.65;
hs.fadeInOut = true;
hs.align = 'center';
hs.captionEval = 'this.a.title';


// Add the slideshow controller
hs.addSlideshow({
	slideshowGroup: 'group5',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: 0.75,
		position: 'bottom center',
		offsetX: 0,
		offsetY: -15,
		hideOnMouseOut: true
	}
});

// gallery config object
var config5 = {
	slideshowGroup: 'group5',
	thumbnailId: 'thumb5',
	numberPosition: 'caption',
	transitions: ['expand', 'crossfade']
};


// gallery config object
var config1 = {

	thumbnailId: 'thumb1',

	transitions: ['expand', 'crossfade']
};

var config2 = {

	thumbnailId: 'thumb2',

	transitions: ['expand', 'crossfade']
};

var config3 = {

	thumbnailId: 'thumb3',

	transitions: ['expand', 'crossfade']
};
var config4 = {

	thumbnailId: 'thumb4',

	transitions: ['expand', 'crossfade']
};