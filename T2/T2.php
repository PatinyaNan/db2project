
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Test</title>

<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
<script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

        <script>
        var editor; // use a global for the submit and return data rendering in the examples

        $(document).ready(function() {
            editor = new $.fn.dataTable.Editor( {
                ajax: '../php/dates.php?format=custom',
                table: '#example',
                fields: [ {
                        label: 'First name:',
                        name:  'first_name'
                    }, {
                        label: 'Last name:',
                        name:  'last_name'
                    }, {
                        label:      'Updated date:',
                        name:       'updated_date',
                        type:       'date',
                        def:        function () { return new Date(); },
                        dateFormat: 'm/d/yy'
                    }, {
                        label:      'Registered date:',
                        name:       'registered_date',
                        type:       'date',
                        def:        function () { return new Date(); },
                        dateFormat: 'DD d MM yy'
                    }
                ]
            } );

            $('#example').DataTable( {
                dom: 'Bfrtip',
                ajax: '../php/dates.php?format=custom',
                columns: [
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'updated_date' },
                    { data: 'registered_date' }
                ],
                select: true,
                buttons: [
                    { extend: 'create', editor: editor },
                    { extend: 'edit',   editor: editor },
                    { extend: 'remove', editor: editor }
                ]
            } );
        } );
        </script>
    </head>
    <body>
        <table class="display" id="example" width="100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Updated date</th>
                <th>Registered date</th>
            </tr>
        </thead>
    </table>
    </body>
</html>
