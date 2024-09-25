<script setup>
//All libery import
import config from "@/utils/config";
import { useBrandStore } from '@/stores/brand';
import { useCategoryStore } from '@/stores/category';
import { useProductStore } from '@/stores/product';
import { useCartStore } from '@/stores/cart';
import { useCustomerStore } from '@/stores/customer';
import { useOrderStore } from '@/stores/order';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import { ErrorMessage } from 'vee-validate';
import { Modal } from 'bootstrap';
import _ from 'lodash';

//All instance
const brandStore = useBrandStore();
const categoryStore = useCategoryStore();
const productStore = useProductStore();
const orderStore = useOrderStore();
const cartStore = useCartStore();
const customerStore = useCustomerStore();
const router = useRouter();
const swal = inject('$swal');

brandStore.swal = swal;

cartStore.swal = swal;
cartStore.router = router;

orderStore.swal = swal;
orderStore.router = router;
//All veriable
let cartModal = ref(null);
let cartModalObj = null;

let orderModal = ref(null);
let orderModalObj = null;

const schema = reactive({
    customer_mobile: 'required|min:11|max:14',
    payment_method: 'required',
    due_amount: 'required',
    pay_amount: 'required',
    subtotal: 'required',
    discount: 'required',
    total: 'required'
})


const searchKeyword = ref('');
const base_url=config.base_url;
const filter = reactive({
    category_id:'',
    brand_id:''
});

const openCartModal = (product) => {
    console.log(product);
    productStore.product = product;
    cartModalObj.show();

    cartFormData.product_id = product.id;
    cartFormData.product_name = product.name;
    cartFormData.price = product.sell_price;
    cartFormData.subtotal = product.sell_price * cartFormData.qty;
}

const cartFormData = reactive({
    product_id:'',
    product_name:'',
    qty:1,
    price:0,
    subtotal:0
});
const orderFormData =reactive({
    'customer_phone':null,
    'pay_amount':0,
    'due_amount':0,
    'subtotal':0,
    'discount':0,
    'total':0,
    'payment_method':'cash',
});
//All methods
const resetCartFormData =() =>{
    cartFormData.product_id=null;
    cartFormData.product_name=null;
    cartFormData.qty=1;
    cartFormData.price=0;
    cartFormData.subtotal=0;
}
const resetOrderFormData =() =>{
    orderFormData.customer_phone=null;
    orderFormData.pay_amount=0;
    orderFormData.due_amount=0;
    orderFormData.subtotal=0;
    orderFormData.discount=0;
    orderFormData.total=0;
    orderFormData.payment_method='cash';
}

const increaseQty= ()=>{
    cartFormData.subtotal = cartFormData.price * cartFormData.qty;
}
const addToCart = (cardData)=>{
    console.log(cardData);
    cartStore.storeCartItem(cardData);
    cartModalObj.hide();

    resetCartFormData();
    cartStore.getCartItems();
}
const deleteFromCart = (card_id)=>{
    console.log(card_id);
    cartStore.removeCartItem(card_id);

    cartStore.getCartItems();
}

const orderConfirmModal =()=>{
    console.log(cartStore.subtotal)
    orderFormData.subtotal = parseFloat(cartStore.subtotal);
    orderFormData.due_amount =parseFloat(cartStore.subtotal);
    orderFormData.pay_amount=parseFloat(cartStore.subtotal);
    orderFormData.total=parseFloat(cartStore.subtotal);
    orderModalObj.show();
}

const confirmOrder = ()=>{
    console.log(orderFormData);
    orderStore.storeOrder(orderFormData);
    orderModalObj.hide();
    resetOrderFormData();
    productStore.getProducts(1, productStore.dataLimit+2);
    cartStore.getCartItems();
}
//Hooks & Computed
onMounted(()=>{
   

    cartModalObj = new Modal(cartModal.value);
    orderModalObj = new Modal(orderModal.value);
    categoryStore.getAllCategories();
    customerStore.getAllCustomers();
    brandStore.getAllBrands();
    productStore.getProducts(1, productStore.dataLimit);
    productStore.getProducts(1, productStore.dataLimit+2);
    cartStore.getCartItems();
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
        productStore.getProducts(productStore.pagination.currentPage,productStore.limit,current,filter);
},500));

</script>
<template>
   <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div id="h4" class="card-title">Card List</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Price</th>
                                                <th>Quentity</th>
                                                <th>Sub Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(cart,index) in cartStore.carts" :key="cart.id">
                                                <td>{{ index + 1 }}</td>
                                                <td>{{ cart.product?.name }}</td>
                                                <td>{{ cart.product?.code }}</td>
                                                <td>{{ cart.price }}</td>
                                                <td width="150">
                                                    <span @click.prevent="cartStore.decreaseCartItem(cart.id)" class="btn btn-danger"><i class='bx bxs-minus-square' ></i></span>
                                                    {{ cart.qty }}
                                                    <span  @click.prevent="cartStore.increaseCartItem(cart.id)" class=" btn btn-success"><i class='bx bxs-plus-square' ></i></span>
                                                </td>
                                                <td width="100">{{ cart.subtotal }}</td>
                                                <td>
                                                    <a class="btn btn-danger" @click.prevent="deleteFromCart(cart.id)" href="javascript:void(0)"><i class='bx bxs-trash-alt'></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">Sub Total</div>
                                                <div class="col-md-6 text-end">{{ cartStore.subtotal }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Discount</div>
                                                <div class="col-md-6 text-end">0</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">Tax</div>
                                                <div class="col-md-6 text-end">0</div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">Grand Total</div>
                                                <div class="col-md-6 text-end">{{ cartStore.subtotal }} BDT</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="btn btn-primary" @click.prevent="orderConfirmModal()">Order Confirm</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h2>Product List</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <vee-field as="select" v-model="filter.category_id" @change="productStore.getProducts(productStore.pagination.currentPage,productStore.limit,searchKeyword,filter)" name="category_id" class="form-control mb-3"
                                        id="category_id">
                                        <option value="">Select a Category</option>
                                        <option :value="category.id" v-for="(category,index) in categoryStore.categories" :key="category.id">{{category.name}}</option>
                                    </vee-field>
                                </div>
                                <div class="col-md-4">
                                    <vee-field as="select" v-model="filter.brand_id" @change="productStore.getProducts(productStore.pagination.currentPage,productStore.limit,searchKeyword,filter)" name="brand_id" class="form-control mb-3"
                                        id="brand_id">
                                        <option value="">Select a Brand</option>
                                        <option :value="brand.id" v-for="(brand,index) in brandStore.brands" :key="brand.id">{{brand.name}}</option>
                                    </vee-field>
                                </div>
                                <div class="col-md-4">
                                    <input type="search" v-model="searchKeyword" placeholder="Search ..." class="form-control" id="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4" v-for="(product,index) in productStore.products" :key="product.id">
                            <a class="" href="#" @click.prevent="openCartModal(product)">
                                <div class="card">
                                    <div class="card-content">
                                        <img :src="base_url+product.file" class="card-img-top img-fluid" width="50%" height="50%" alt="Product Image">
                                        <div class="card-body text-center">
                                            <h4 class="card-title">{{ product.name }}</h4>
                                            <p>{{ product.sell_price }}</p>
                                            <span class="badge" :class="product.stock > 0 ? 'bg-success': 'bg-danger'">
                                                <span v-if="product.stock > 0">Available: </span>
                                                <span v-else>Stock Out: </span>
                                                {{ product.stock }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>

<!--Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel" aria-hidden="true" ref="cartModal">
    <div class="modal-dialog  modal-lg model-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">{{productStore.product?.name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="cart-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img :src="base_url+productStore.product?.file" class="card-img-top img-fluid" width="50%" height="50%" alt="Product Image">
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="sale_price">Sale Price</label>
                                        <input type="number" :value=" productStore.product?.sell_price" name="sell_price" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sale_price">Original Price</label>
                                        <input type="number" name="original_price" class="form-control" :value="productStore.product?.original_price " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="sale_price">Purchase QTY</label>
                                        <input type="number" min="1" name="qty" @change="increaseQty()" v-model="cartFormData.qty" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sale_price">Stock</label>
                                        <input name="stock" type="number" class="form-control" :value="productStore.product?.stock " disabled>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-md-6">
                                        <label for="barcode">Bar Code</label>
                                        <img :src="productStore.product?.barcode" id="barcode" alt=" Bar code" class="img-fluid">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="subtotal">Sub Total</label>
                                        <input type="number" :value="cartFormData.subtotal" name="subtotal" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click.prevent="addToCart(cartFormData)" class="btn btn-primary">Add To Cart</button>
            </div>
        </div>
    </div>
</div>
<!--Order Confirm Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true" ref="orderModal">
    <div class="modal-dialog  modal-lg model-dialog-centered" role="document">
        <div class="modal-content">
            <vee-form :validation-schema="schema" @submit="confirmOrder">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Confirm Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="customer-mobile" class="form-label"> Customer Mobile</label>
                            <vee-field type="tel" name="customer_mobile" v-model="orderFormData.customer_mobile" class="form-control"
                            placeholder="Please enter customer mobile number"
                            />
                            <ErrorMessage class="text-danger" name="customer_mobile" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <vee-field as="select" name="payment_method" v-model="orderFormData.payment_method" class="form-select">
                                <option value="">Select Payment Method</option>
                                <option :value="method" v-for="(method,index) in orderStore.payment_method" :key="index">{{ method }}</option>
                            </vee-field>
                            <ErrorMessage class="text-danger" name="payment_method" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pay_amount" class="form-label">Pay Amount (BDT)</label>
                            <vee-field type="number" name="pay_amount" v-model="orderFormData.pay_amount" class="form-control" min="0"/>
                            <ErrorMessage class="text-danger" name="pay_amount" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_amount" class="form-label">Due Amount (BDT)</label>
                            <vee-field type="number" name="due_amount" v-model="orderFormData.due_amount" class="form-control" min="0"/>
                            <ErrorMessage class="text-danger" name="due_amount" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="subtotal" class="form-label">Subtoal (BDT)</label>
                            <vee-field type="number" name="subtotal" v-model="orderFormData.subtotal" class="form-control" min="0"/>
                            <ErrorMessage class="text-danger" name="subtotal" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="discount" class="form-label">Discount (BDT)</label>
                            <vee-field type="number" name="discount" v-model="orderFormData.discount" class="form-control" min="0"/>
                            <ErrorMessage class="text-danger" name="discount" />
                        </div>

                        <hr>
                        <div class="col-md-12">
                            <label for="total" class="form-label">Grand Total (BDT)</label>
                            <vee-field type="number" name="total" v-model="orderFormData.total" class="form-control" min="0"/>
                            <ErrorMessage class="text-danger" name="total" />
                        </div>

                    </div>
                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm Order</button>
                </div>
            </vee-form>
        </div>
    </div>
</div>
</template>