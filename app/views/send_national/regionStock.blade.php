
<div class="panel-group" id="accordion">
    @foreach (Region::all() as $region)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $region->id }}" class="open">
                    {{ $region->region }} <i class="fa fa-chevron-down pull-right"></i>
                </a>
            </h4>
        </div>
        <div id="collapse{{ $region->id }}" class="panel-collapse collapse">
            <div class="panel-body">
                {{ $region }}
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function(){
        $('.collapsible').on('hidden.bs.collapse', function () {
            alert("dfjkafkld")
        })
    })
</script>
@stop