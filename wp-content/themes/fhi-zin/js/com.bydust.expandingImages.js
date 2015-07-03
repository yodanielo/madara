var BDExpandingImagesObject = null;
BDExpandingImages = function(){
		
	return{
		currentID : 0,
		currentStep : 1,
		nextID : null,
		itemIDs : Array(),
		range : 3,
		scaleNormal : 0.8,
		scaleHover : 1.4,
		scales : Array(),
		classNormal : '',
		classHover : '',
		width : 100,
		height : 100,
		
		add : function(id){
			this.itemIDs.push(id);
		},
		create : function(){
			for(var i = 0; i < arguments.length; i++){
				this.add(arguments[i]);
			}
			window.onload = this.init;
			BDExpandingImagesObject = this;
		},
		init : function(){
			for(var i = 0; i < BDExpandingImagesObject.itemIDs.length; i++){
				var obj = document.getElementById(BDExpandingImagesObject.itemIDs[i]);
				if(obj) obj.onmouseover = function(){BDExpandingImagesObject.hover(this.id);}
			}
		},
		hover : function(id){
			if( id != null && BDExpandingImagesObject.currentStep < 1){
				BDExpandingImagesObject.nextID = id;
				//setTimeout(function(){BDExpandingImagesObject.hover();},40);
				return;
			}
			
			var itemIDs = BDExpandingImagesObject.itemIDs;
			var height = BDExpandingImagesObject.height;
			var width = BDExpandingImagesObject.width;
			var scaleN = BDExpandingImagesObject.scaleNormal;
			if(id != null){
				//console.info('nieuw id ' + id);
				var spot = itemIDs.indexOf(id);
				var range = BDExpandingImagesObject.range;
				var classNormal = BDExpandingImagesObject.classNormal;
				var classHover = BDExpandingImagesObject.classHover;
				var scaleH = BDExpandingImagesObject.scaleHover;
				var scaleDiff = scaleH - scaleN;
				var scales = new Array();
				for(var r = 0; r <= range; r++){
					scales[spot - r] = scaleH - (r*(scaleDiff/range));
					scales[spot + r] = scaleH - (r*(scaleDiff/range));
				}
				BDExpandingImagesObject.scales = scales;
				BDExpandingImagesObject.currentID = id;
				BDExpandingImagesObject.currentStep = 0;
				BDExpandingImagesObject.nextID = null;
				for(var i = 0; i < itemIDs.length; i++){
					var obj = document.getElementById(itemIDs[i]);
					if(obj && i == spot && classHover != '') obj.className = classHover;
					else if(obj && i != spot && classNormal != '') obj.className = classNormal;
				}
			}else{
				//console.info('bestaand id');
				var scales = BDExpandingImagesObject.scales;
			}
			
			var currentStep = BDExpandingImagesObject.currentStep + 0.1;
			var nextID = BDExpandingImagesObject.nextID;
			for(var i = 0; i < itemIDs.length; i++){
				var obj = document.getElementById(itemIDs[i]);
				if(obj && scales[i]){
					obj.width = ((scales[i] * width) - obj.width) * currentStep + obj.width;
					obj.height = ((scales[i] * height) - obj.height) * currentStep + obj.height;
				}else if(obj){
					obj.width = ((scaleN * width) - obj.width) * currentStep + obj.width;
					obj.height = ((scaleN * height) - obj.height) * currentStep + obj.height;
				}
			}
			BDExpandingImagesObject.currentStep = currentStep;
			if(currentStep < 1 && nextID == null) setTimeout('BDExpandingImagesObject.hover()',20);
			else if(nextID != null){
				BDExpandingImagesObject.currentStep = 1;
				BDExpandingImagesObject.hover(nextID);
			}
		}
	};
}