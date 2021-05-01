@foreach($data as $key=> $kelompok)
<center><label for="exampleInputPassword1">{{$kelompok->kelompok}}</label></center>
@if(count($kelompok->items))
@foreach($kelompok->items as  $item)
<div class="form-group">
	<label for="exampleInputPassword1">{{$item->item}}</label>
	<input type="text" name="items[{{$key}}][jumlah]" class="form-control" id="exampleInputPassword1" placeholder="{{$item->item}}">
	<input type="hidden" name="items[{{$key}}][id_item]" value="{{$item->id_item}}">
</div>
@endforeach
@endif
@endforeach