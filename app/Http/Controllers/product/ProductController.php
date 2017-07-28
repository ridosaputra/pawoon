<?php
/**
 * Class ProductController
 * @email uda_rido@yahoo.com
 * @author ridosaputra
 * @description master product
 **/
namespace Pawoon\Http\Controllers\product;


use Pawoon\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Pawoon\Models\ProductModel;

class ProductController extends Controller
{
    function __construct() 
    {
        
    }
    
    /**
    * Function HTML BackEnd
    * @backend display Product
    **/
    public function htmlPage(Request $request)
    {
        return view('product');
    }
    
    /**
    * Function Upload Image
    * @return JSON
    **/
    public function uploadImage(Request $request)
    {
        $success = TRUE;
        $response = FALSE;
        $add_response_aray = array();
        $message = "Fail upload image";
        $cek_file = $request->file("txtpictemp");
        if ($request->hasFile("txtpictemp"))
        {
            $message = "Not image type";               
            $new_filename  = $cek_file->getClientOriginalName()."_".uniqid() . '.' . strtolower( $cek_file->getClientOriginalExtension() );
            $path = public_path('images/');
            if(substr($cek_file->getMimeType(), 0, 5) == 'image') 
            {
                $response = TRUE;
                $message = "Success upload image";
                $cek_file->move($path, $new_filename);
                $add_response_aray["data"] = array(
                    "filename" => $new_filename,
                    "full_url" => url("/")."/images/".$new_filename,
                    "original" => $cek_file->getClientOriginalName(),
                    "size" => $cek_file->getClientSize(),
                );
            }
        }
        else
        {
            $message = "undefined file name upload";
        }
        return $this->response($success, $response, $message, $add_response_aray, FALSE);
    }
    
    /**
    * Function List Data Product
    * @return JSON
    **/
    public function listData(Request $request)
    {
        $success = TRUE;
        $response = FALSE;
        $message = "Fail load data";
        $add_response_aray = array();
        $star = (isset($_GET['iDisplayStart'])) ? (int)$_GET['iDisplayStart']:0;
        $limit = (isset($_GET['iDisplayLength'])) ? (int)$_GET['iDisplayLength']:10;
        $sEcho = (isset($_GET['sEcho'])) ? (int)$_GET['sEcho']:1;
        $sSortDir_0 = (isset($_GET['sSortDir_0'])) ? $_GET['sSortDir_0']:"desc";
        $iSortCol_0 = (isset($_GET['iSortCol_0'])) ? (int)$_GET['iSortCol_0']:0;
        $icolumn = (isset($_GET['iColumns'])) ? (int)$_GET['iColumns']:1;
        $scolumn = (isset($_GET['sColumns'])) ? (int)$_GET['sColumns']:1;
        $sSearch = (isset($_GET['sSearch'])) ? $_GET['sSearch']:"";
        $jns_sorting = "desc";
        if($sSortDir_0=="asc")
        {
            $jns_sorting="asc";
        }
        $keysearchdt = "name";
        if($iSortCol_0==0)
        {
            $keysearchdt = "id";
        }
        else if($iSortCol_0==1)
        {
            $keysearchdt = "name";
        }
        else if($iSortCol_0==2)
        {
            $keysearchdt = "price";
        }
        $tempdata = ProductModel::where('name','like','%'.$sSearch.'%')->skip($star)->take($limit)->orderBy($keysearchdt, $jns_sorting)->get();
        $countdata = (int)ProductModel::where('name','like','%'.$sSearch.'%')->count();
        $add_response_aray = array(
            "sEcho" => intval($sEcho),
            "iTotalRecords" => $countdata,
            "iTotalDisplayRecords" => $countdata,
            "aaData" => array()
	);
        $i = $star + 1;
        if($tempdata)
        {
            $response = TRUE;
            $message = "Data found";
            foreach($tempdata as $dt)
            {       
                $generatemenu = "<div class='action-buttons'>";
                $generatemenu .= "<a href='javascript:void(0);' onclick='editdata(\"". $dt->id ."\");' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;";
                $generatemenu .= "<a href='javascript:void(0);' onclick='hapusdata(\"". $dt->id ."\");' class='btn btn-danger btn-xs' ><i class='glyphicon glyphicon-remove-sign'></i></a>"; 
                $generatemenu .= "</div>";
                $add_response_aray['aaData'][] = array(
                    $dt->id,
                    $dt->name,
                    $dt->price,
                    (($dt->picture != "") ? "<img src='".url("/")."/images/".$dt->picture."' class='img-responsive img-thumbnail' />" : ""),
                    $generatemenu,
                );
                $i++;           
            }  
        }
        if($request->ajax())
        {
            return $this->response($success, $response, $message, $add_response_aray );
        }
        return Redirect::action('product\ProductController@htmlPage');
    }
    
    /**
    * Function Get One Data Product
    * @return JSON
    **/
    public function getOne(Request $request)
    {
        $success = TRUE;
        $response = FALSE;
        $add_response_aray = array();
        $message = "Fail load data";
        $validator = Validator::make(array_map('trim',$request->all()),
            array(
                'id' => 'required|numeric'
            )
        );
        if($validator->fails()) 
        {
            $message = "";
            $list_error = $validator->errors()->all();
            foreach($list_error as $dtmessage)
            {
                $message .= $dtmessage;
            }
        }
        else
        {
            $id = (int)$request->input('id');
            $getdata = ProductModel::find($id);
            $message = "Data not found";
            if($getdata)
            {
                $response = TRUE;
                $add_response_aray['data'] = $getdata;
                $message = "Found your data";
            }
        }
        if($request->ajax())
        {
            return $this->response($success, $response, $message, $add_response_aray );
        }
        return Redirect::action('product\ProductController@htmlPage');
    }
    
    /**
    * Function Create or Update Data Product
    * @return JSON
    **/
    public function createUpdate(Request $request)
    {
        $success = TRUE;
        $response = FALSE;
        $add_response_aray = array();
        $message = "Fail save data";
        $validator = Validator::make(array_map('trim',$request->all()),
            array(
                'txtid' => 'numeric',
                'txtname' => 'required|string|max:250',
                'txtprice' => 'required|numeric'
            )
        );
        if($validator->fails()) 
        {
            $message = "";
            $list_error = $validator->errors()->all();
            foreach($list_error as $dtmessage)
            {
                $message .= $dtmessage;
            }
        }
        else
        {
            $id = (int)$request->input('txtid');
            $name = $request->input('txtname'); 
            $txtproductpic = $request->input('txtproductpic'); 
            $txtprice = $request->input('txtprice'); 
            $getdata = ProductModel::find($id);
            if($txtprice == "")
            {
                $txtprice = NULL;
            }
            $response = TRUE;
            if($getdata)
            {
                $getdata->name = $name;
                $getdata->price = $txtprice;
                $getdata->picture = $txtproductpic;
                $getdata->save();
                $message = "Success update data";
            }
            else
            {
                $obj = new ProductModel;
                $obj->name = $name;
                $obj->price = $txtprice;
                $obj->picture = $txtproductpic;
                $obj->save();
                $message = "Add new record";
            }
        }
        if($request->ajax())
        {
            return $this->response($success, $response, $message, $add_response_aray );
        }
        return Redirect::action('product\ProductController@htmlPage');
    }
    
    /**
    * Function Delete Data Product
    * @return JSON
    **/
    public function delete(Request $request)
    {
        $success = TRUE;
        $response = FALSE;
        $add_response_aray = array();
        $message = "Fail delete data";
        if(is_array($request->input('id')))
        { 
            $response = TRUE;
            $listdrop = array();
            $listdt = count($request->input('id'));
            for($i=0; $i<$listdt; $i++)
            {
                $listdrop[] = (int)$request->input('id')[$i];
            }
            $obj = new ProductModel;
            $obj->destroy($listdrop);
            $message = "Success delete some record";
        }
        else
        {
            $response = TRUE;
            $id = (int)$request->input('id');          
            $cekdata = ProductModel::find($id)->delete();
            $message = "Success delete a record";
        }
        if($request->ajax())
        {
            return $this->response($success, $response, $message, $add_response_aray );
        }
        return Redirect::action('product\ProductController@htmlPage');
    }
    
    
    /*
     * Private Function
     */
    private function response($success=FALSE, $response=TRUE, $message="", $addresponse=array(), $setasjson=FALSE)
    {
        $output["success"] = $success;
        $output["response"] = $response;
        $output["message"] = $message;
        if($addresponse)
        {
            $output = array_merge($output, $addresponse);
        }
        if($setasjson)
        {
            return json_encode($output);
        }
        return response()->json($output);
    }
}
