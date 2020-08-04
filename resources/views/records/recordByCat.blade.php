<script>
    
    $(function () {
    //$.noConflict();
    $('.data-table').DataTable(); 
  });
</script>
<div class="row">
    <div class="col-md-9">
        @if($scat)
        <h3 style="display:inline">{{ $cat }}</h3> - <h5 style="display:inline">{{ $scat }}</h5>
        <hr>
        @else
        <h3>{{ $cat }}</h3>
        @endif
    </div>    
    <div class="ml-auto mr-3" >
    <a href='{{ url("/record") }}'><button class="btn_download"><i class="fa fa-plus"></i> New Record</button></a>
    </div>    
</div>   
<div class="row  mt-sm-5" >
<div class="col-md-12">
    @if(count($recordByCat) >0)
    <table class="table table-bordered data-table" >
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>owner</th>
                <th>date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($recordByCat as $rec_Cat)
            <tr>
                <td>{{ $rec_Cat->id }}</td>
                <td>{{ $rec_Cat->record_title }}</td>
                <td>{{ $rec_Cat->first_name }} {{ $rec_Cat->last_name }}</td>
                <td>{{ $rec_Cat->record_date }}</td>
                <td>
                <a href='{{ url("/view/{$rec_Cat->id}") }}'><button class="btn_prevue"><i class="fa fa-eye"></i> Prevue</button></a>
                <a href='{{ url("/download/{$rec_Cat->record_file}") }}'><button class="btn_download"><i class="fa fa-download"></i> Download</button></a>
                <a href='{{ url("/edit/{$rec_Cat->id}") }}'><button class="btn_edit"><i class="fa fa-edit"></i> Edit</button></a>
                <a href='{{ url("/delete/{$rec_Cat->id}") }}'><button class="btn_delete"><i class="fa fa-trash"></i> Delete</button></a>
                </td>
            </tr>
        @endforeach
    </tbody>
    @else
    <h3>No data available</h3>
    @endif
    </table>
</div>
</div> 