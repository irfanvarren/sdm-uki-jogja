<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\HrdModel;

    class hrdController extends Controller
    {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        if($request->id_user != ""){
            return response()->json(HrdModel::where('id_user',$request->id_user)->get(),200);
        }else if($request->id != ""){
            return response()->json(HrdModel::find($request->id),200);
        }
       return response()->json(HrdModel::all(),200);
   }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function addData(Request $req)
    {

        $data = HrdModel::create($req->all());
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
      $check = HrdModel::firstWhere('id_admin',$id);
      if($check){
        $data = HrdModel::find($id)->update($req->all());
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
        $check = HrdModel::firstWhere('id_admin',$id);
        if($check){
            $data = HrdModel::find($id)->delete();
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
