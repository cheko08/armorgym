Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

new Vue({
	el: '#guestbook',

	data: {
		newMessage: {
			name: '',
			message: ''
		},
		submitted:false
	},



	computed:{
		errors: function(){
			for(var key in this.newMessage){
				if(! this.newMessage[key])
					return true;
			}
			return false;
		}
	},

	ready: function(){
		this.fetchMessages();

	},

	methods: {

		submittedClear: function(){
			this.submitted = false;
		},

		fetchMessages: function(){
			this.$http.get('/public/api/messages', function(messages){
				this.$set('messages', messages);

			});
		},

		onSubmitForm: function(){
			var message = this.newMessage;
			this.newMessage = {name:'', message: ''}
			this.$http.post('/public/api/messages', message).success(function(message){
               this.messages.push(message);
            });
			this.submitted = true;
			setTimeout(this.submittedClear, 3000);
		},

		deleteMessage: function(message){
			this.$http.post('/public/api/delete/' + message.id);
			this.messages.$remove(message);
		},
	}

});