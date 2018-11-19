var getName = {
	__construct : function(string){
		var pos = 0;
		for (var i = 0; i <= string.length - 1; i++) {
			if(string[i] == ' '){
				pos = i;
			}
		}
		var name = string.substr(pos, string.length);
		return name;
	}
}
var getSlug = {
	__construct: function(string){

	}
}
