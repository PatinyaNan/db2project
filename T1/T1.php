
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>test</title>
        <style>
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
        <script>
        var editor; // use a global for the submit and return data rendering in the examples

        $(document).ready(function() {
        editor = new $.fn.dataTable.Editor( {
            ajax: "../php/staff.php",
            table: "#example",
            template: '#customForm',
            fields: [ {
                    label: "First name:",
                    name: "first_name"
                }, {
                    label: "Last name:",
                    name: "last_name"
                }, {
                    label: "Position:",
                    name: "position"
                }, {
                    label: "Office:",
                    name: "office"
                }, {
                    label: "Extension:",
                    name: "extn"
                }, {
                    label: "Start date:",
                    name: "start_date",
                    type: "datetime"
                }, {
                    label: "Salary:",
                    name: "salary"
                }
            ]
        } );

        $('#example').DataTable( {
            dom: "Bfrtip",
            ajax: "../php/staff.php",
            columns: [
                { data: null, render: function ( data, type, row ) {
                    // Combine the first and last names into a single table field
                    return data.first_name+' '+data.last_name;
                } },
                { data: "position" },
                { data: "office" },
                { data: "extn" },
                { data: "start_date" },
                { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
            ],
            select: true,
            buttons: [
                { extend: "create", editor: editor },
                { extend: "edit",   editor: editor },
                { extend: "remove", editor: editor }
            ]
        } );
        } );
        </script>
    </head>
    <body>
        <div id="customForm">
                       <fieldset class="name">
                           <legend>Name</legend>
                           <editor-field name="first_name"></editor-field>
                           <editor-field name="last_name"></editor-field>
                       </fieldset>
                       <fieldset class="office">
                           <legend>Office</legend>
                           <editor-field name="office"></editor-field>
                           <editor-field name="extn"></editor-field>
                       </fieldset>
                       <fieldset class="hr">
                           <legend>HR info</legend>
                           <editor-field name="position"></editor-field>
                           <editor-field name="salary"></editor-field>
                           <editor-field name="start_date"></editor-field>
                       </fieldset>
                   </div>

<table id="example" class="display" cellspacing="0" width="100%">
                   <thead>
                       <tr>
                           <th>Name</th>
                           <th>Position</th>
                           <th>Office</th>
                           <th>Extn.</th>
                           <th>Start date</th>
                           <th>Salary</th>
                       </tr>
                   </thead>
                   <tfoot>
                       <tr>
                           <th>Name</th>
                           <th>Position</th>
                           <th>Office</th>
                           <th>Extn.</th>
                           <th>Start date</th>
                           <th>Salary</th>
                       </tr>
                   </tfoot>
               </table>
    </body>
</html>
