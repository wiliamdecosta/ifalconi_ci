<div class="search-criteria" style="display:none;">
    Filter : 
    <select id="user_status_criteria">
        <option value=""> Choose Status </option>
        <option value="1">ACTIVE</option>
        <option value="0">NEW USER</option>
        <option value="2">INACTIVE</option>
        <option value="3">BLOCKED</option>
    </select>
</div>

<script>
    jQuery(function($) {
        $( ".actionBar" ).append(".search-criteria");
        $(".search-criteria").show();
    });
</script>