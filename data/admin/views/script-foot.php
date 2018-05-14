<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables/dataTables.buttons.min.js"></script>
<script src="http://www.direct2guests.tv/js/plugins/dataTables/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script>

</script>
<!--<script src="assets/js/my_jquery.js"></script>-->
<script src="assets/js/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

<script>
$('.dynamicDataTables').DataTable({
	dom: 'Blfrtip',
	buttons: ['copy', 'excel', 'pdf','print'],
	ordering:true,
	searching:true,
	bFilter:true,
	language: { search: "" }
});
</script>

