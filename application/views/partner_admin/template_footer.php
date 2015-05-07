<div id="footer">
        <div class="container">
            <p class="text-muted"> Government of Kenya &copy <?php echo date('Y'); ?>. All Rights Reserved</p>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    $(document).ready(function() {
        $('#message').hide();
        $('#change_password_btn').click(function() {   
            var old_pass = $('#old_pass').val();
            var new_pass = $('#new_pass').val();
            var confirm_pass = $('#confirm_pass').val();
            var user_id = $('#user_id').val();  
            if(new_pass!=confirm_pass){
                $('#message').show();
                $('#message').val('Sorry the Passwords do Not Match. Please Retry');                
                $('#message').css('color','red');
            }else{ 
                $.post("<?php echo base_url() . 'rtk_management/change_password'; ?>", {                
                    new_pass: new_pass,                                          
                    user_id:user_id,
                }).done(function(data) {                     
                    $('#message').val(data); 
                    $('#message').show();               
                    $('#message').css('color','green');
                    setTimeout(function(){
                        $('#Change_Password').modal('hide');
                    }, 5000);
                });
            }
        });
    });
       
    </script>
    <script src="<?php echo base_url() . 'assets/datatable/jquery.dataTables.min.js' ?>" type="text/javascript"></script>	
    <script src="<?php echo base_url() . 'assets/datatable/dataTables.bootstrap.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/TableTools.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/ZeroClipboard.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/datatable/dataTables.bootstrapPagination.js' ?>" type="text/javascript"></script>

    <script src="<?php echo base_url() . 'assets/scripts/jquery-ui-1.10.4.custom.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/scripts/highcharts.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/scripts/exporting.js' ?>" type="text/javascript"></script>  
    <script src="<?php echo base_url() . 'assets/boot-strap3/js/bootstrap.min.js' ?>" type="text/javascript"></script>	
    <script type="text/javascript" src="<?php echo base_url() . 'assets/scripts/jquery.loadingbar.js' ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/loadingbar.css' ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/elusive-webfont.css' ?>" />
    <div id="window-resizer-tooltip" style="display: none;"><a href="#" title="Edit settings" style="background-image: url(chrome-extension://kkelicaakdanhinjdeammmilcgefonfh/images/icon_19.png);"></a><span class="tooltipTitle">Window size: </span><span class="tooltipWidth" id="winWidth">1366</span> x <span class="tooltipHeight" id="winHeight">768</span><br><span class="tooltipTitle">Viewport size: </span><span class="tooltipWidth" id="vpWidth">1366</span> x <span class="tooltipHeight" id="vpHeight">449</span></div></body></html>

    <div class="modal fade" id="Change_Password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="new_change_password">       
                    <table id="change_password_table">
                      <tr>    
                        <td>Old Password</td>
                        <td colspan="3"><input class="form-control" id="old_pass" type="text" name="old_pass" style="width:96%"/></td>
                      </tr>   
                      <tr>
                        <td>New Password</td>
                        <td colspan="3"><input class="form-control" id="new_pass" type="text" name="new_pass" style="width:96%"/></td>
                      </tr>             
                      <tr>
                        <td>Confirm Password</td>
                        <td colspan="3"><input class="form-control" id="confirm_pass" type="text" name="confirm_pass" style="width:196%"/></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                            <input class="form-control" id="message" type="text" name="message" style="width:96%" />
                        </td>                        
                      </tr>                                     
                        
                     <input class="form-control" id="user_id" type="hidden" name="user_id" style="width:96%" value="<?php echo $this->session->userdata('user_id'); ?>"/>
                      
                    </table>
                  </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="change_password_btn" class="btn btn-primary">Change</button>
              </div>
            </div>
          </div>
        </div>
</body>
</html>