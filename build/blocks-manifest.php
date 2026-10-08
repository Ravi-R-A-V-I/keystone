<?php
// This file is generated. Do not modify it manually.
return array(
	'featured-property-cards-container' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/featured-property-cards-container',
		'version' => '0.1.0',
		'title' => 'Featured Property Cards Container',
		'category' => 'widgets',
		'icon' => 'category',
		'description' => 'Featured Property Cards Container.',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'featured-property-cards-container',
		'editorScript' => 'file:./index.js',
		'editorStyle' => array(
			'file:./index.css',
			'dashicons'
		),
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'keystone-footer' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/keystone-footer',
		'version' => '0.1.0',
		'title' => 'Keystone Footer Block',
		'category' => 'widgets',
		'icon' => 'palmtree',
		'description' => 'Keystone Footer Block.',
		'attributes' => array(
			'logoUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'logoId' => array(
				'type' => 'number',
				'default' => 0
			)
		),
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'keystone-footer-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'keystone-header' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/keystone-header',
		'version' => '0.1.0',
		'title' => 'Keystone Header Block',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Keystone Header Block.',
		'attributes' => array(
			'logoUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'logoId' => array(
				'type' => 'number',
				'default' => 0
			)
		),
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'keystone-header',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'keystone-properties' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/keystone-properties',
		'version' => '0.1.0',
		'title' => 'Keystone Properties',
		'category' => 'widgets',
		'icon' => 'location-alt',
		'description' => 'Keystone Properties Main Block.',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'keystone-properties',
		'editorScript' => 'file:./index.js',
		'editorStyle' => array(
			'file:./index.css',
			'dashicons'
		),
		'style' => array(
			'file:./style-index.css',
			'leaflet-style'
		),
		'render' => 'file:./render.php',
		'viewScriptModule' => array(
			'file:./view.js',
			'leaflet-script'
		)
	),
	'keystone-property-card' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/keystone-property-card',
		'version' => '0.1.0',
		'title' => 'Keystone Property Card',
		'category' => 'widgets',
		'icon' => 'admin-multisite',
		'description' => 'keystone properties card',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'keystone-property-card',
		'editorScript' => 'file:./index.js',
		'editorStyle' => array(
			'file:./index.css',
			'dashicons'
		),
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'keystone-property-featured-cards' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/keystone-property-card',
		'version' => '0.1.0',
		'title' => 'Keystone Property Card',
		'category' => 'widgets',
		'icon' => 'admin-multisite',
		'description' => 'keystone properties card',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'keystone-property-card',
		'editorScript' => 'file:./index.js',
		'editorStyle' => array(
			'file:./index.css',
			'dashicons'
		),
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'keystone-search' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/keystone-search',
		'version' => '0.1.0',
		'title' => 'Keystone Search Block',
		'category' => 'widgets',
		'icon' => 'search',
		'description' => 'Keystone Search Block.',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'attributes' => array(
			'size' => array(
				'type' => 'string',
				'default' => 'medium'
			),
			'alignment' => array(
				'type' => 'string',
				'default' => 'center'
			)
		),
		'textdomain' => 'keystone-search',
		'editorScript' => 'file:./index.js',
		'editorStyle' => array(
			'file:./index.css',
			'dashicons'
		),
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'my-interactive-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/my-interactive-block',
		'version' => '0.1.0',
		'title' => 'My Interactive Block',
		'category' => 'widgets',
		'icon' => 'media-interactive',
		'description' => 'An interactive block with the Interactivity API.',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'my-interactive-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	),
	'my-interactive-block copy' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/my-interactive-block',
		'version' => '0.1.0',
		'title' => 'My Interactive Block',
		'category' => 'widgets',
		'icon' => 'media-interactive',
		'description' => 'An interactive block with the Interactivity API.',
		'example' => array(
			
		),
		'supports' => array(
			'interactivity' => true
		),
		'textdomain' => 'my-interactive-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScriptModule' => 'file:./view.js'
	)
);
