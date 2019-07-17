    </div><!-- /#wrapper -->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

	<script type="text/javascript" src="js/main.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script>
        $(document).ready(function(e){
            $('.search-panel .dropdown-menu').find('a').click(function(e) {
                e.preventDefault();
                var param = $(this).attr("href").replace("#","");
                var concept = $(this).text();
                $('.search-panel span#search_concept').text(concept);
                $('.input-group #search_param').val(param);
            });
        });
			function myhref(web){
			window.location.href = web;}

            $(document).ready(function() {
                $('#post_category').multiselect();
                $('.multiselect-container input[type="checkbox"]').each(function(index,input){
                $(input).after( "<span></span>" );;
                });
            });

    </script>

</body>

</html>