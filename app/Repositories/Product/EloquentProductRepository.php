<?php namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\BulkUpload\BulkUpload;
use App\Models\Cart\Cart;

class EloquentProductRepository extends DbRepository
{
	/**
	 * Event Model
	 * 
	 * @var Object
	 */
	public $model;

	/**
	 * Module Title
	 * 
	 * @var string
	 */
	public $moduleTitle = 'Product';

	/**
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'title' 			=> 'Title',
		'company_name' 		=> 'Company Name',
		'product_type' 		=> 'Product Type',
		'product_sub_type' 	=> 'Product Sub Type',
		'barcode' 			=> 'Barcode',
		'manufacturer_sku' 	=> 'Manufacturer SKU',
		'retailer_sku' 		=> 'Retailer SKU',
		'actions' 			=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'title' => [
			'data' 			=> 'title',
			'name' 			=> 'title',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'company_name' => [
			'data' 			=> 'company_name',
			'name' 			=> 'company_name',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'product_type' => [
			'data' 			=> 'product_type',
			'name' 			=> 'product_type',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'product_sub_type' => [
			'data' 			=> 'product_sub_type',
			'name' 			=> 'product_sub_type',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'barcode' => [
			'data' 			=> 'barcode',
			'name' 			=> 'barcode',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'manufacturer_sku' => [
			'data' 			=> 'manufacturer_sku',
			'name' 			=> 'manufacturer_sku',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'retailer_sku' => [
			'data' 			=> 'retailer_sku',
			'name' 			=> 'retailer_sku',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'actions' => [
			'data' 			=> 'actions',
			'name' 			=> 'actions',
			'searchable' 	=> false, 
			'sortable'		=> false
		]
	];

	/**
	 * Is Admin
	 * 
	 * @var boolean
	 */
	protected $isAdmin = false;

	/**
	 * Admin Route Prefix
	 * 
	 * @var string
	 */
	public $adminRoutePrefix = 'admin';

	/**
	 * Client Route Prefix
	 * 
	 * @var string
	 */
	public $clientRoutePrefix = 'frontend';

	/**
	 * Admin View Prefix
	 * 
	 * @var string
	 */
	public $adminViewPrefix = 'backend';

	/**
	 * Client View Prefix
	 * 
	 * @var string
	 */
	public $clientViewPrefix = 'frontend';

	/**
	 * Module Routes
	 * 
	 * @var array
	 */
	public $moduleRoutes = [
		'listRoute' 	=> 'product.index',
		'createRoute' 	=> 'product.create',
		'storeRoute' 	=> 'product.store',
		'editRoute' 	=> 'product.edit',
		'updateRoute' 	=> 'product.update',
		'deleteRoute' 	=> 'product.destroy',
		'dataRoute' 	=> 'product.get-list-data',
		'bulkUploadRoute' => 'product.bulk-upload'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'product.index',
		'createView' 	=> 'product.create',
		'editView' 		=> 'product.edit',
		'deleteView' 	=> 'product.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 			= new Product;
	}

	/**
	 * Create Event
	 *
	 * @param array $input
	 * @return mixed
	 */
	public function create($input)
	{
		$input = $this->prepareInputData($input, true);
		$model = $this->model->create($input);

		if($model)
		{
			// Attach Ingredients
			$this->attachIngredients($model, $input);

			return $model;
		}

		return false;
	}	

	/**
	 * Update Event
	 *
	 * @param int $id
	 * @param array $input
	 * @return bool|int|mixed
	 */
	public function update($id, $input)
	{
		$model = $this->model->find($id);

		if($model)
		{
			$input = $this->prepareInputData($input);		
				
			// Attach Ingredients
			$this->attachIngredients($model, $input);
			
			return $model->update($input);
		}

		return false;
	}

	/**
	 * Destroy Event
	 *
	 * @param int $id
	 * @return mixed
	 * @throws GeneralException
	 */
	public function destroy($id)
	{
		$model = $this->model->find($id);
			
		if($model)
		{
			return $model->delete();
		}

		return  false;
	}

	/**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
    	if(isset($orderBy) && $sort)
    	{
    		return $this->model->orderBy($orderBy, $sort)->get();	
    	}

    	return $this->model->all();
    }

	/**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
    	if($id)
    	{
    		return $this->model->find($id);
    	}
        
        return false;
    }   

    /**
     * Get Table Fields
     * 
     * @return array
     */
    public function getTableFields()
    {
    	return [
			$this->model->getTable().'.id as id',
			$this->model->getTable().'.title',
			$this->model->getTable().'.price',
			$this->model->getTable().'.product_code',
			$this->model->getTable().'.product_type',
			$this->model->getTable().'.product_sub_type',
			$this->model->getTable().'.barcode',
			$this->model->getTable().'.description',
			$this->model->getTable().'.company_name',
			$this->model->getTable().'.manufacturer_sku',
			$this->model->getTable().'.retailer_sku',
			$this->model->getTable().'.image',
			$this->model->getTable().'.image1',
			$this->model->getTable().'.image2',
			$this->model->getTable().'.image3'
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    				->get();
        
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
    	$this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     * 
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
    	return $input;
    }

    public function attachIngredients($model = null, $input = array())
    {
    	if(isset($input['ingredients']))
    	{
    		return $model->ingredients()->sync($input['ingredients']);
    	}
    }

    /**
     * Get Table Headers
     * 
     * @return string
     */
    public function getTableHeaders()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableHeaders));
    	}

    	$clientHeaders = $this->tableHeaders;

    	unset($clientHeaders['username']);

    	return json_encode($this->setTableStructure($clientHeaders));
    }

	/**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
    	if($this->isAdmin)
    	{
    		return json_encode($this->setTableStructure($this->tableColumns));
    	}

    	$clientColumns = $this->tableColumns;

    	unset($clientColumns['username']);
    	
    	return json_encode($this->setTableStructure($clientColumns));
    }

    /**
     * Get User Cart
     * 
     * @param int $userId
     * @return bool
     */
    public function getUserCart($userId = null)
    {
    	if($userId)
    	{
    		return Cart::where('user_id', $userId)->with('product')->orderBy('product_id')->get();
    	}

    	return false;
    }

    public function addToCart($userId = null, $productId = null, $qty = 1)
    {
    	if($userId && $productId)
    	{
    		// Delete Old Values
    		Cart::where(['product_id' => $productId, 'user_id' => $userId])->delete();

    		// Added to Cart
    		return Cart::create([
    			'user_id' 		=> $userId,
    			'product_id' 	=> $productId,
    			'qty'			=> $qty
    		]);
    	}

    	return false;
    }

    public function removeProductFromCart($userId = null, $productId = null)
    {
    	if($userId && $productId)
    	{
    		// Delete Old Values
    		return Cart::where(['product_id' => $productId, 'user_id' => $userId])->delete();
    	}

    	return false;
    }

    public function bulkUpload($fileName, $products)
    {
    	BulkUpload::create([
    		'title' => $fileName
    	]);

    	$allProductCode = $this->model->pluck('product_code')->toArray();

    	unset($products[0]);

    	foreach($products as $product)
    	{
    		if(isset($product[2]) && !in_array($product[2], $allProductCode))
    		{
    			$productData[] = [
    				'category_id'	=> isset($product[0]) ? $product[0] : 1,
    				'title' 		=> isset($product[1]) ? $product[1] : 'Product -'.$product[2],
    				'product_code' 	=> $product[2],
    				'qty' 			=> isset($product[4]) ? $product[4] : 0,
    				'price' 		=> isset($product[3]) ? $product[3] : 0,
    				'description' 	=> isset($product[5]) ? $product[5] : '',
    				'image' 		=> isset($product[6]) ? $product[6] : 'default.png',
    				'image1' 		=> isset($product[7]) ? $product[7] : null,
    				'image2' 		=> isset($product[8]) ? $product[8] : null,
    				'image3' 		=> isset($product[9]) ? $product[9] : null,
    				'image4' 		=> isset($product[10]) ? $product[10] : null
    			];
    		}
    	}

    	$this->model->insert($productData);

    	return count($productData);

    }

    public function getAllByCategoryId($categoryId = null, $orderBy = 'id', $sort = 'asc')
    {
    	if($categoryId)
    	{
    		return $this->model->where('category_id', $categoryId)->orderBy($orderBy, $sort)->get();	
    	}

    	return $this->model->all();   	
    }
}