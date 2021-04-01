<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\KepalaUnitModel;

    class KepalaUnitController extends Controller
    {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        if($request->id_user != ""){
            return response()->json(KepalaUnitModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(KepalaUnitModel::find($request->id),200);
        }
       return response()->json(KepalaUnitModel::all(),200);
   }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function addData(Request $req)
    {

        $data = KepalaUnitModel::create($req->all());
        return response()->json([
            "status" => "OK",
            "message" => "Data berhasil ditambahkan",
        ],200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $req, $id)
    {
      $check = KepalaUnitModel::firstWhere('id_kepala_unit',$id);
      if($check){
        $data = KepalaUnitModel::find($id)->update($req->all());
        return response()->json([
            "status" => "OK",
            "message" => "Data berhasil diubah"
        ],200);
    }else{
     return response()->json([
        'status' => 'Not Found',
        'message' => 'Id kepala unit tidak ditemukan',
    ],404);
 }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delData($id)
    {
        $check = KepalaUnitModel::firstWhere('id_kepala_unit',$id);
        if($check){
            $data = KepalaUnitModel::find($id)->delete();
            return response()->json([
                "status" => "OK",
                "message" => "Data berhasil dihapus"
            ]);
        }else{
           return response()->json([
            'status' => 'Not Found',
            'message' => 'Id kepala unit tidak ditemukan',
        ],404);
       }
   }
}
