<!doctype html>
<head>    
    <title>DataTables, ajax, modal e bootstrap</title>

    <link rel="stylesheet" type="text/css" href="styles.css">    
    
    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-sm">Adicionar curso</button>
            </div>
            <div class="card-body" style="padding: 0px;">
                <h4 class="text-center">DataTables, ajax, jquery, modal e bootstrap</h4>
                <table id="course_table" class="table table-striped">
                    <thead class="thead-dark">    
                        <th width="30%">Código</th>
                        <th width="50%">Nome do curso</th>  
                        <th width="30%">Nº Estudantes</th>
                        <th scope="col" width="10%">Editar</th>
                        <th scope="col" width="10%">Excluir</th>
                    </thead>
                </table>
            </div>
        </div>    
    </div>               

    <div id="userModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar curso</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="course_form" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-body">
                                <label>Digite o nome do curso</label>
                                <input type="text" name="course" id="course" class="form-control" />
                                <br />
                                <label>Digite o número de alunos</label>
                                <input type="text" name="students" id="students" class="form-control" />
                                <br /> 
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="course_id" id="course_id" />
                                <input type="hidden" name="operation" id="operation" />
                                <!---->
                                <input type="submit" name="action" id="action" class="btn btn-primary" value="Adicionar"/>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" language="javascript" >
    $(document).ready(function(){
    
        $(document).on('submit', '#course_form', function(event){
            event.preventDefault();
            var id = $('#id').val();
            var course = $('#course').val();
            var students = $('#students').val();

            if(course != '' && students != ''){
                $.ajax({
                    url: "insert.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        $('#course_form')[0].reset();
                        $('#userModal').modal('hide');
                        dataTable.ajax.reload();
                    }
                });
            }
            else{
                alert("Os campos (nome do curso e número de alunos) são obrigatórios !");
            }
        });

        $('#add_button').click(function(){
            $('#course_form')[0].reset();
            $('.modal-title').text("Adicionar detalhes do curso");
            $('#action').val("Salvar");
            $('#operation').val("Salvar");
        });
        
        $(document).on('click', '.update', function(){
            var course_id = $(this).attr("id");
            $.ajax({
                url:"fetch_single.php",
                method:"POST",
                data:{course_id:course_id},
                dataType:"json",
                success:function(data){
                    $('#userModal').modal('show');
                    $('#id').val(data.id);
                    $('#course').val(data.course);
                    $('#students').val(data.students);
                    $('.modal-title').text("Editar detalhes do curso");
                    $('#course_id').val(course_id);
                    $('#action').val("Adicionar");
                    $('#operation').val("Adicionar");
                }
            })
        }); 

        $(document).on('click', '.delete', function(){
            var course_id = $(this).attr("id");
            if(confirm("Tem certeza que deseja excluir este registro ?")){
                $.ajax({
                    url:"delete.php",
                    method:"POST",
                    data:{course_id:course_id},
                    success:function(data)
                    {
                        dataTable.ajax.reload();
                    }
                });
            }
            else{
                return false;   
            }
        });

        var dataTable = $('#course_table').DataTable({
            "responsive": true,
            "paging":     true,
            "processing": false,
            "serverSide": true,
            "order":      [],
            "info":       true,        
            ajax:{
                url:"fetch.php",
                type:"POST"
            },

            columnDefs:[
                {
                    "targets":[0,3,4],
                    "orderable":false,
                },
            ],

            language: {
                sEmptyTable: "Nenhum registro encontrado",
                sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                sInfoFiltered: "(Filtrados de _MAX_ registros)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "_MENU_ resultados por página",
                sLoadingRecords: "Carregando...",
                sProcessing: "Processando...",
                sZeroRecords: "Nenhum registro encontrado",
                sSearch: "Pesquisar",
                oPaginate: {
                    sNext: "Próximo",
                    sPrevious: "Anterior",
                    sFirst: "Primeiro",
                    sLast: "Último"
                },
                oAria: {
                    sSortAscending: ": Ordenar colunas de forma ascendente",
                    sSortDescending: ": Ordenar colunas de forma descendente"
                }

            }
        });
    });
</script>