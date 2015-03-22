<?php include '../view/header.php'; ?>
<section role=main>

    <div class="slim clearfix">
         <div class="job-filters clearfix job-left" >

            <form id="filter-jobs" name="filter-jobs" method="post" action="?action=list_jobs">
                    <h4 class="job-inline">Filter results</h4>
                <div class="job-drop-down">
                    <select name="categories" id="categories" >
                        <option value="allcategories">--Select Category--</option>
                                                    <option value="4"  >Motion Graphics</option>

                                                        <option value="7"  >Videography</option>

                                                        <option value="8"  >Web Design</option>

                                                        <option value="9"  >Web Development</option>

                                                </select>
                </div>             
               
                <div class="job-drop-down">
                    <select name="cities" >
                        <option value="allcities">--Select City---------</option>
                                                    <option value="Brampton, ON"  >Brampton, ON</option>

                                                        <option value="Dallas, TX"  >Dallas, TX</option>

                                                        <option value="London"  >London</option>

                                                        <option value="Toronto, ON"  >Toronto, ON</option>

                                                </select>
                </div>
                <div class="job-drop-down">
                    <select name="countries" >
                        <option value="allcountries">--Select Country---</option>
                                                    <option value="Canada"  >Canada</option>

                                                        <option value="United Kingdom"  >United Kingdom</option>

                                                        <option value="USA"  >USA</option>

                                                </select>
                </div>
                    <input type="submit" name="submitfilter" value="Filter" class="fa fa-filter job-inline-button job-right" />

            </form>
            <form method="post" class="job-inline job-right">
            <button type="submit" name="resetfilter" value ="Reset" class="fa fa-remove job-inline-button job-right"></button>
            </form>
         </div><!--end filters div -->
    </div>
</section>

 <script type="text/javascript" src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
<script type="text/javascript">
$("#categories").on("change", function() {
    var $form = $("#filter-jobs");
    var method = $form.attr("method") ? $form.attr("method").toUpperCase() : "GET";
    $.ajax({
        url: $form.attr("action"),
        data: $form.serialize(),
        type: method,
        success: function() {
            // do stuff with the result, if you want to 
        }
    });
});
</script>
<?php include '../view/footer.php'; ?>