<head>

	<title>DataTables example - Custom form layout / templates</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
	<style type="text/css">


#customForm {
	display: flex;
	flex-flow: row wrap;
}

#customForm fieldset {
	flex: 1;
	border: 1px solid #aaa;
	margin: 0.5em;
}

#customForm fieldset legend {
	padding: 5px 20px;
	border: 1px solid #aaa;
	font-weight: bold;
}

#customForm fieldset.name {
	flex: 2 100%;
}

#customForm fieldset.name legend {
	background: #bfffbf;
}

#customForm fieldset.office legend {
	background: #ffffbf;
}

#customForm fieldset.hr legend {
	background: #ffbfbf;
}

#customForm div.DTE_Field {
	padding: 5px;
}


	</style>
    <div class="DTED DTED_Lightbox_Wrapper" style="opacity: 1; top: 0px;"><div class="DTED_Lightbox_Container"><div class="DTED_Lightbox_Content_Wrapper"><div class="DTED_Lightbox_Content" style="height: auto;"><div class="DTE DTE_Action_Create"><div data-dte-e="head" class="DTE_Header"><div class="DTE_Header_Content">Create new entry</div></div><div data-dte-e="processing" class="DTE_Processing_Indicator"><span></span></div><div data-dte-e="body" class="DTE_Body"><div data-dte-e="body_content" class="DTE_Body_Content" style="max-height: 383px;"><div data-dte-e="form_info" class="DTE_Form_Info" style="display: none;"></div><form data-dte-e="form" class="" style="display: block;"><div data-dte-e="form_content" class="DTE_Form_Content"><div id="customForm">
    						<fieldset class="name">
    							<legend>Name</legend>
    							<editor-field name="first_name"></editor-field><div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_first_name"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_first_name">First name:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_first_name" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    							<editor-field name="last_name"></editor-field><div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_last_name"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_last_name">Last name:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_last_name" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    						</fieldset>
    						<fieldset class="office">
    							<legend>Office</legend>
    							<editor-field name="office"></editor-field><div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_office"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_office">Office:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_office" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    							<editor-field name="extn"></editor-field><div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_extn"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_extn">Extension:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_extn" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    						</fieldset>
    						<fieldset class="hr">
    							<legend>HR info</legend>
    							<editor-field name="position"></editor-field><div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_position"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_position">Position:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_position" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    							<editor-field name="salary"></editor-field><div class="DTE_Field DTE_Field_Type_text DTE_Field_Name_salary"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_salary">Salary:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_salary" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    							<editor-field name="start_date"></editor-field><div class="DTE_Field DTE_Field_Type_datetime DTE_Field_Name_start_date"><label data-dte-e="label" class="DTE_Label" for="DTE_Field_start_date">Start date:<div data-dte-e="msg-label" class="DTE_Label_Info"></div></label><div data-dte-e="input" class="DTE_Field_Input"><div data-dte-e="input-control" class="DTE_Field_InputControl" style="display: block;"><input id="DTE_Field_start_date" type="text"></div><div data-dte-e="multi-value" class="multi-value" style="display: none;">Multiple values<span data-dte-e="multi-info" class="multi-info" style="display: none;">The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.</span></div><div data-dte-e="msg-multi" class="multi-restore" style="display: none;">Undo changes</div><div data-dte-e="msg-error" class="DTE_Field_Error" style="display: none;"></div><div data-dte-e="msg-message" class="DTE_Field_Message" style="display: none;"></div><div data-dte-e="msg-info" class="DTE_Field_Info"></div></div></div>
    						</fieldset>
    					</div></div></form></div></div><div data-dte-e="foot" class="DTE_Footer" style="text-indent: -1px;"><div class="DTE_Footer_Content"></div><div data-dte-e="form_error" class="DTE_Form_Error" style="display: none;"></div><div data-dte-e="form_buttons" class="DTE_Form_Buttons"><button class="btn" tabindex="0">Create</button></div></div></div><div class="DTED_Lightbox_Close"></div></div></div></div></div>
