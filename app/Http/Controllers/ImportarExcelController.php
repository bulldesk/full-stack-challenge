<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;

class ImportarExcelController extends Controllers
{
	function index(){
		$data = DB::table('csv')->orderBy('id', 'DESC')->get();
		return view('importar_excel', compact('data'));
	}
	function importar(Request $request)
	{
		$this->validate($request, [
			'select_file' => 'required|mimes:xls,xlsx'
		]);

		$path = $request->file('select_file')->getRealPath();

		$data = Excel::load($path)->get();

		if($data->count() > 0){
			foreach ($data->toArray() as $key => $value) {
				foreach ($value as $row) {
					$insert_data[] = array(
						'nome' => $row['nome'];
						'email' => $row['email'];
						'cpf_cnpj' => $row['cpf_cnpj'];
						'empresa' => $row['empresa'];
						'profissao_cargo' => $row['profissao_cargo'];
						'telefone' => $row['telefone'];
						'cidade' => $row['cidade'];
						'estado' => $row['estado'];
						'pais'	=> $row['pais'];
						'status' => $row['status'];
						'estagioDoFunil' => $row['estagioDoFunil'];
						'tituloDoNegocio' => $row['tituloDoNegocio'];
						'ValorDoNegocio' => $row['ValorDoNegocio'];
						'conversoes' => $row['conversoes'];
						'ultimaConversao' => $row['ultimaConversao'];
						'dominio' => $row['dominio'];
						'dataDeCadastro' => $row['dataDeCadastro'];
						'url' => $row['url'];
					);
				}
			}
			if(!empty($insert_data)){
				DB::table('csv')->insert($insert_data);
			}
		}
		return back()->with('success', 'Excel Data Imported sucessfully');
	}
}