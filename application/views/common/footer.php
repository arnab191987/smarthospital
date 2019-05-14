			
		</div><!--- Main container -->
	</div><!--- Container body end -->
	<!-- jQuery -->
    <script src="<?php echo $base_url; ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo $base_url; ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $base_url; ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo $base_url; ?>vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $base_url; ?>vendors/iCheck/icheck.min.js"></script>
	    <!-- Parsley -->
    <script src="<?php echo $base_url; ?>vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="<?php echo $base_url; ?>vendors/autosize/dist/autosize.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo $base_url; ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo $base_url; ?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo $base_url; ?>vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo $base_url; ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo $base_url; ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo $base_url; ?>build/js/custom.min.js"></script>
    
    <!-- jQuery Smart Wizard -->
    <script src="<?php echo $base_url; ?>vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $base_url; ?>vendors/iCheck/icheck.min.js"></script>
    
  
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            singleDatePicker: true,
            calender_style: "picker_4"
        },function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#discharge_date').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            singleDatePicker: true,
            calender_style: "picker_4"
        },function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        
        $('#birthday_to').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            singleDatePicker: true,
            calender_style: "picker_4"
        },function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        
        //alert($("#showAmount").html());
        
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        
        ///// For Bill details page//////
        $('#datatable1').dataTable();
        $('#datatable2').dataTable();
        $('#datatable3').dataTable();
        ///// For Bill details page//////
        
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
        
        // Code writtent for Bill register showing The total amount ///
        $("#wrapAmpount").hide()
        var showAmount=$("#wrapAmpount").html();
        $(".billReg").after(showAmount);
        /// End of coding for bill register //
        
        $(".close").click(function(){
            $(this).parent().hide();
        });

        //// Start of all jquery writtent for purchaser page no 3 for adddtion /////

        
        $("#CloneContainer").on("click",".clone",function(){
            var html=  $( "#CloneContainer tr:last" ).clone();
            var counter= html.find(".counter").html();
            var counterSl= html.find(".counterSl").html();
            counter=parseInt(counter)+1;
            counterSl=parseInt(counterSl)+1;
            html.find(".counter").text(counter);
            html.find(".counterSl").text(counterSl);
            html.find("input").each(function() {
                this.name = this.name.replace(/\[\d+\]/, "["+counter+"]");   
            });
            calculateGrandTotalForPurchaserItem();
            $(".remove").removeClass( "hidden" );  
            $("#CloneContainer").append(html);
        })

        $('#CloneContainer').on('blur','.amount',function(){ 
            calculateGrandTotalForPurchaserItem();
        });

        function calculateGrandTotalForPurchaserItem(){
            /********************** amount calculat ************/
            amount=0;

            $('.amount').each(function(index,elem){
            val=$(this).val();
            amount=(parseInt(amount)+parseInt(val));
            $('.total_amount').val(amount);
            });

            /*************************  End  ****************/
        }

        $("#CloneContainer").on("click",".remove",function(){
            $length=$("#CloneContainer  tr").length;
            if($length>1)
            $(this).closest( "tr" ).remove();
            var counterSl=1;
            $( "#CloneContainer" ).find(".counterSl").each(function() {
                $(this).text(counterSl);
                counterSl=parseInt(counterSl)+1;
            });
            calculateGrandTotalForPurchaserItem();
        });

        $('#CloneContainer').on('blur','.qty',function(){ 
            price=$(this).parent().parent().find('.pricepurchaser').val();
            qty=$(this).val();
            price=(parseInt(qty)*parseInt(price));
            $(this).parent().parent().find('.amount').val(price);
            calculateGrandTotalForPurchaserItem();
        });

        $('#CloneContainer').on('blur','.pricepurchaser',function(){ 
            price=$(this).val();
            qty=$(this).parent().parent().find('.qty').val();
            price=(parseInt(qty)*parseInt(price));
            $(this).parent().parent().find('.amount').val(price);
            calculateGrandTotalForPurchaserItem();
        });
        //// End of of all jquery writtent for purchaser page no 3 for adddtion //////

        //// Start of check ledger is uniq or not, in supplier entry /////

        $('#supplier_ledger').blur(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/supplier/checkunique/"+$(this).val(),
            }).done(function(data) {
                if(data=="true"){
                    $("#errorLedger").show();
                }
                else{
                    $("#errorLedger").hide();
                }
            });
        });

        //// End of check ledger is uniq or not, in supplier entry //////
        
        /// Bill Edit Ajax listed below///
        
        $('#bedNo').change(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/bedinfoajax/"+$(this).val()+"/"+$('#qty').val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.rate="Rs. "+obj.rate;
             $('#bedType').val("");
             $('#bedType').val(obj.bed_type);
             $('#bedCharge').val("");
             $('#bedCharge').val(obj.rate);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#qty').blur(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/bedinfoajax/"+$('#bedNo').val()+"/"+$(this).val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.rate="Rs. "+obj.rate;
             $('#bedType').val("");
             $('#bedType').val(obj.bed_type);
             $('#bedCharge').val("");
             $('#bedCharge').val(obj.rate);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#service_name').change(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/serviceinfoajax/"+$(this).val()+"/"+$('#qtyservice').val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.service_charge="Rs. "+obj.service_charge;
             $('#serviceCharge').val("");
             $('#serviceCharge').val(obj.service_charge);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#qtyservice').blur(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/serviceinfoajax/"+$('#service_name').val()+"/"+$(this).val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.service_charge="Rs. "+obj.service_charge;
             $('#serviceCharge').val("");
             $('#serviceCharge').val(obj.service_charge);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#doctorName').change(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/doctorinfoajax/"+$(this).val()+"/"+$('#qtydoctor').val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.doctor_charge="Rs. "+obj.doctor_charge;
             $('#doctorCharge').val("");
             $('#doctorCharge').val(obj.doctor_charge);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#qtydoctor').blur(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/doctorinfoajax/"+$('#doctorName').val()+"/"+$(this).val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.doctor_charge="Rs. "+obj.doctor_charge;
             $('#doctorCharge').val("");
             $('#doctorCharge').val(obj.doctor_charge);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#machineName').change(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/machinaryinfoajax/"+$(this).val()+"/"+$('#qtymachine').val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.charge="Rs. "+obj.charge;
             $('#machinaryCharge').val("");
             $('#machinaryCharge').val(obj.charge);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        $('#qtymachine').blur(function() {
            $.ajax({
             url: "<?php echo $base_url; ?>index.php/bill/machinaryinfoajax/"+$('#machineName').val()+"/"+$(this).val(),
            }).done(function(data) {
             //$( this ).addClass( "done" );
             //alert(data);
             var obj = $.parseJSON(data);
             obj.charge="Rs. "+obj.charge;
             $('#machinaryCharge').val("");
             $('#machinaryCharge').val(obj.charge);
             $('#unit').val("");
             $('#unit').val(obj.unit);
             $('#totalAmount').val("");
             $('#totalAmount').val(obj.amount);
            });
        });
        
        /// End of bill edit ajax ////
      });
    </script>

  </body>
</html>