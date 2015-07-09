function rdySection(sectionId, title){
	$("#modalTitle").html(title);
	$("#txtSectionId").val(sectionId);
	return;
}
function rdyFile(subSectionId){
	
}

$(function(){
	//create new section button
	$("#btnCreateSection").on("click",function(e){
		$("#txtId").val(0);
		$("#txtDescription").val("");
		rdySection(0,"Create New Section");
		return;
	});
	//create new subsection button
	if ( $("a[name=btnCreateSubsection]").length ){
		$("a[name=btnCreateSubsection]").on("click",function(e){
			$("#txtId").val(0);
			$("#txtDescription").val("");
			rdySection($(this).data('sectionid'),"Create New Subsection");
			return;
		});
	}
	//edit section button
	if ( $("a[name=btnEditSection]").length ){
		$("a[name=btnEditSection]").on("click",function(e){
			$("#txtDescription").val($(this).data('sectiondesc'));
			$("#txtId").val($(this).data('sectionid'));
			rdySection($(this).data('sectionid'),$(this).text());
			return;
		});
	}
	//add new document
	if ( $("a[name=btnAddNewDocument]").length ){
		$("a[name=btnAddNewDocument]").on("click",function(e){
			$("#txtDocSectionId").val($(this).data('sectionid'));
			return;
		});
	}
	
});