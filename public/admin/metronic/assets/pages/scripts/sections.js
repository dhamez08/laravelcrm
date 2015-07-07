function rdySection(sectionId, subSectionId, title){
	$("#modalTitle").html(title);
	$("#txtSectionId").val(sectionId);
	$("#txtSubsectionId").val(subSectionId);
	return;
}
function rdyFile(sectionId,subSectionId){
	
}

$(function(){
	$("#btnCreateSection").on("click",function(e){
		rdySection(0,0,"Create New Section");
		return;
	});
	$("input[name=btnCreateSubsection").on("click",function(e){
		rdySection($(this).data('sectionid'),0,"Create New Section");
		return;
	});
});