<script src="{{ asset('admin/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.slicknav.min.js') }}"></script>

<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="{{ asset('admin/assets/js/line-chart.js') }}"></script>
<!-- all pie chart -->
<script src="{{ asset('admin/assets/js/pie-chart.js') }}"></script>
<!-- others plugins -->
<script src="{{ asset('admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('admin/assets/js/scripts.js') }}"></script>

{{-- date picker cdn scripts  --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

{{-- data tables cdn scripts  --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.1/datatables.min.js"></script>


{{-- data table code  --}}
<script>
    $(document).ready(function() {
    $('#data-table').DataTable();

    $(document).ready( function(){
          $("#image").change(function(e){
            var reader = new FileReader(); 
            reader.onload = function(e){
              $("#showImage").attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
          })
        })
} );
</script>


