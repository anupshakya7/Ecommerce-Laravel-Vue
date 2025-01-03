<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{asset('assets/js/index.js')}}"></script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="https://developercodez.com/developerCorner/parsley/parsley.min.js"></script>
<script>
    $(document).ready(function(f){
        $('#formSubmit').on('submit',function(e){
            if($(this).parsley().validate()){
                e.preventDefault();
                var formData = new FormData(this);
                var html = `<button class="btn btn-primary" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									Loading...</button>`;
                var html1 = `<input type="submit" id="submitButton" class="btn btn-primary px-4"
                                                        value="Submit" />`;
                $('#submitButton').html(html);
                $.ajax({
                    type:'POST',
                    url:$(this).attr('action'),
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function(result){
                        if(result.status == 'Success'){
                            $('#submitButton').html(html1);
                        }else{
                            $('#submitButton').html(html);
                        }
                    },
                });
                $('#submitButton').html(html);
            }
        })
    })
</script>