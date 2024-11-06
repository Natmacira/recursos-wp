/**
 * This file handles the submission of Forms.
 *
 * Uses '/ajax.js';
 */

var CodeableTestForm = {
	form : null,

	messageElement: null,

	init : function() {
		this.messageElement = this.form.getElementsByClassName( 'codeable-test-response-message' )[0];

		this.form.dataset.isCodeableTestFormListening = true;

		this.form.addEventListener(
			'submit', function( e ) {
				e.preventDefault();

				this.submit();
			}.bind( this )
		);
	},

	submit : function() {
		this.messageElement.innerText = '';
		this.messageElement.className = 'codeable-test-response-message';

		var ajax = new AJAX();

		ajax.url        = this.form.action;
		ajax.method     = this.form.method;
		ajax.parameters = new FormData( this.form );
		ajax.parameters.append( 'action', 'codeable_test_submit_form' ); //this corresponds to wp_action: wp_ajax_codeable_test_submit_form.

		ajax.callbacks.success = function( response ) {
			if ( response.success ) {
				this.form.className           = 'codeable-test-ajax-form submission-success';
				this.messageElement.innerText = response.data.message;
				this.messageElement.className = 'codeable-test-response-message success';
			} else {
				this.enable( true );
				this.messageElement.innerText = response.data.message;
				this.form.className           = 'codeable-test-ajax-form submission-error';
				this.messageElement.className = 'codeable-test-response-message error';
			}
		}.bind( this );

		ajax.callbacks.error = function( response ) {
			this.enable( true );
			this.messageElement.innerText = response.data.message;
			this.form.className           = 'codeable-test-ajax-form submission-error';
		}.bind( this );

		/**
		 * When we start sending we disable the form elements and add a class
		 * for styling purposes.
		 */
		this.enable( false );
		this.form.className = 'codeable-test-ajax-form codeable-test-sending';

		document.dispatchEvent( new Event( 'CodeableTestFormSubmissionStart' ) );

		ajax.send();
	},

	enable : function( enable ) {
		for ( var i in this.form.elements ) {
			this.form.elements[ i ].disabled = ! enable;
		}
	},
};

var CodeableTestFormsInit = function() {
	var formElements = document.getElementsByClassName( 'codeable-test-ajax-form' );
	var forms = {};

	for ( let i = 0; i < formElements.length; i++ ) {
		forms.i = Object.create( CodeableTestForm );
		forms.i.form = formElements[ i ];
		forms.i.init();
	}
};

if ( 'complete' === document.readyState ) {
	CodeableTestFormsInit();
} else {
	document.addEventListener( 'DOMContentLoaded', CodeableTestFormsInit );
}
