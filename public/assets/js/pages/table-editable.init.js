$((function(){var t={};$(".table-edits tr").editable({dropdowns:{gender:["Male","Female"]},edit:function(t){$(".edit i",this).removeClass("fa-pencil-alt").addClass("fa-save").attr("title","Save")},save:function(e){$(".edit i",this).removeClass("fa-save").addClass("fa-pencil-alt").attr("title","Edit"),this in t&&(t[this].destroy(),delete t[this])},cancel:function(e){$(".edit i",this).removeClass("fa-save").addClass("fa-pencil-alt").attr("title","Edit"),this in t&&(t[this].destroy(),delete t[this])}})}));