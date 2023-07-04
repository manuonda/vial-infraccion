<script>

  var module_util = (function() {
   
    var isNumber = function (evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
    }

    var changeToUpper = function(event) {
      let valor  = event.value.toUpperCase();
      event.value = valor;
    }

    return {
    	isNumber : isNumber,
      changeToUpper : changeToUpper
    }


  }());
</script>