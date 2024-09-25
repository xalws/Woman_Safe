</main>
<footer>
    <br>
</footer>

<script>
    $(document).ready(function () {
        $('table').DataTable({
            "pageLength": 3,
            "lengthMenu": [
                [5, 10, 20, 50],
                [5, 10, 20, 50]
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>