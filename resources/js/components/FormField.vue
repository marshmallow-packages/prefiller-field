<template>
	<div v-if="nova_vue_component === 'form-text-field'">
		<form-text-field v-if="renderComponent" :field="field" :errors="errors" :show-help-text="showHelpText"/>
	</div>
	<div v-else-if="nova_vue_component === 'form-currency-field'">
		<form-currency-field v-if="renderComponent" :field="field" :errors="errors" :show-help-text="showHelpText"/>
	</div>
    <div v-else-if="nova_vue_component === 'form-date-field'">
		<form-date-field v-if="renderComponent" :field="field" :errors="errors" :show-help-text="showHelpText"/>
	</div>
    <div v-else-if="nova_vue_component === 'form-select-field'">
		<form-select-field v-if="renderComponent" :field="field" :errors="errors" :show-help-text="showHelpText"/>
	</div>
	<div v-else>
  		<p class="px-8 py-6">
  			The field type <strong>{{ nova_vue_component }}</strong> is not implemented yet. Please create an issue or send us a pull request.
  		</p>
	</div>
</template>

<script>

import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
	data() {
      	return {
        	renderComponent: true,
        	nova_vue_component: null,
      	};
    },

  	mixins: [FormField, HandlesValidationErrors],

  	props: ['resourceName', 'resourceId', 'field'],

  	mounted() {
  		let vue = this;
  		this.nova_vue_component = this.field.nova_vue_component

  		document.addEventListener('change',function(e){
  			if (e.target.getAttribute('dusk') == vue.field.source_field) {
  				if (!vue.field.value || vue.field.update_filled_allowed === true) {
  					vue.getPrefillerValue(e.target.value)
  				}
  			}
		});
  	},

  	methods: {
  		getPrefillerValue(source_value) {
  			let vue = this;

  			var params = {
	        	source_field_identifier: vue.field.source_field,
	        	target_field_type: vue.field.field_type,
	        	prefill_with: vue.field.prefill_with,
	        	source_field: vue.field.source_field,
	        	source_model: vue.field.source_model,
	        	source_column: vue.field.source_column,
	        	source_value: source_value,
  			}

  			Nova.request().post('/nova-vendor/prefiller-field/', params)
              	.then(response => {
                  	vue.field.value = response.data.value;
  					vue.forceRerender()
              	});

  		},

  		forceRerender() {
	        // Remove my-component from the DOM
	        this.renderComponent = false;
	        this.$nextTick(() => {
	          	// Add the component back in
	          	this.renderComponent = true;
	        });
	     },

	    /*
	     * Set the initial, internal value for the field.
	     */
	    setInitialValue() {
	      	this.value = this.field.value || ''
	    },

	    /**
	     * Fill the given FormData object with the field's internal value.
	     */
	    fill(formData) {
	      	formData.append(this.field.attribute, this.value || '')
	    },
  	},
}
</script>
