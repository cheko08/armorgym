@extends('layouts.app')
@section('title', 'Punto de Venta')
@section('content')
@include('messages.global')
 <div class="container">
 	<div id="ticket">
 		
 	</div>
 </div>

@section('scripts')
<script>
	new Vue({
	el: '#ticket',

	data: {
		newProducto: {
			producto: '',
			codigo: '',
			precio:'',
			cantidad:''
		},
		submitted:false
	},



	computed:{
		errors: function(){
			for(var key in this.newProducto){
				if(! this.newProducto[key])
					return true;
			}
			return false;
		}
	},


	methods: {

		
	}

});
</script>
@endsection
@endsection