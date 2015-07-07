var properties = {
    bootgridinfo:{}
};

properties.bootgridinfo.all = "Semua";
properties.bootgridinfo.noresults = "Data tidak ditemukan";
properties.bootgridinfo.datainfo = "<strong> Menampilkan {{ctx.start}} s.d {{ctx.end}} dari {{ctx.total}} data </strong>";
properties.bootgridinfo.search = "Cari...";
properties.bootgridinfo.loading = '<div align="center"><i class="ace-icon fa fa-spinner fa-spin orange bigger-200"></i> <br/> Loading . . . </div>';
properties.bootgridinfo.progressbar = '<div class="progress progress-striped active"> <div id="loading-progress" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width:100%"> <span id="loading-progress-text" class="progress-completed" style="font-weight:bold;">Please Wait....</span></div></div>';


jQuery(function($) {
    $(window).on('resize', function(){
        resize_bootgrid();      
    });        
});

function resize_bootgrid() {
   if ($(window).width() < 450) {
        $(".actions .btn-group").hide();
   }else {
        $(".actions .btn-group").show();
   }
}
