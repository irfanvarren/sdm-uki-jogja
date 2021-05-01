<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoryGajiModel;
use App\UserModel;
use DateTime;

class historyGajiController extends Controller
{
    public function getAll(Request $request){
        $gaji = new HistoryGajiModel();
        if($request->nip != ""){
            $gaji = $gaji->where('NIP',$request->nip)->join('item_gaji','item_gaji.id_item','history_gaji.id_item');
        }
        if($request->bulan != ""){
            $gaji= $gaji->where('bulan',$request->bulan);
        }
        if($request->id != ""){
            $gaji = $gaji->find($request->id);
            return response($gaji,200);
        }

        return response()->json($gaji->get(),200);
    }
    public function getBulan(Request $request){
        $bulan = HistoryGajiModel::selectRaw('bulan')->groupBy('bulan')->get();
        return response()->json($bulan,200);
    }

    public function laporan(Request $request){
            $select = 'bulan,sum(if(item_gaji.kelompok = "Penerimaan",history_gaji.jumlah,0)) as total_penerimaan,sum(if(item_gaji.kelompok = "Potongan",history_gaji.jumlah,0)) as total_potongan';
        if($request->bulan != ""){
        $select = 'bulan,sum(if(item_gaji.kelompok = "Penerimaan" AND history_gaji.bulan = '.$request->bulan.',history_gaji.jumlah,0)) as total_penerimaan,sum(if(item_gaji.kelompok = "Potongan" AND history_gaji.bulan = '.$request->bulan.',history_gaji.jumlah,0)) as total_potongan';
        }
        $laporan = HistoryGajiModel::selectRaw($select)->leftJoin('item_gaji','item_gaji.id_item','history_gaji.id_item')->get();
        return response()->json($laporan,200);
    }

    public function addData(Request $req){
        $data_input = array();
        $NIP = UserModel::find($req->id_user)->nip;
        $datetime = new DateTime($req->tanggal);
        $tanggal = $datetime->format('d');
        $bulan = $datetime->format('m');
        $tahun = $datetime->format('Y');
        foreach($req->items as $item){
            $temp = array();
            $temp['tanggal'] = $tanggal;
            $temp['bulan'] = $bulan;
            $temp['tahun'] = $tahun;
            $temp['NIP'] = $NIP;
            $temp['id_item'] = $item['id_item'];
            $temp['jumlah'] = $item['jumlah'];
            array_push($data_input,$temp);
        }
        HistoryGajiModel::insert($data_input);
        return response()->json([
            'status' => 'OK',
            'message' => 'Data berhasil ditambahkan'
        ],200);
    }
    public function updateData($id , Request $req){
        $check = HistoryGajiModel::firstWhere('id_history',$id);
     
        if($check){
            $data = HistoryGajiModel::find($id);
            $data->tanggal = $req->tanggal;
            $data->bulan = $req->bulan;
            $data->tahun = $req->tahun;
            $data->NIP = $req->NIP;
            $data->id_item = $req->id_item;
            $data->jumlah = $req->jumlah;
            $data->save();
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil diubah',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id history tidak ditemukan',
            ],404);
        }
    }
    public function delData($id){
        $check = HistoryGajiModel::firstWhere('id_history',$id);
        if($check){
            HistoryGajiModel::destroy($id);
            return response()->json([
                'status' => 'OK',
                'message' => 'Data berhasil dihapus',
            ],200);
        }else{
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Id history tidak ditemukan',
            ],404);
        }
    }
}
