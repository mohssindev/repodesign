<template>
    <div>
        <nav class="bg-gray-800"> <!-- product page here -->
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <h2 class="text-white font-bold text-xl">Product Store</h2>
                </div>
                </div>
            </div>
            </div>
        </nav>

        <div class="mx-auto container">
            <div class="cursor-pointer col-span-6 sm:col-span-3 my-4 float-right w-1/3 py-4">
                <h3 class="font-bold text-xl">Categories :</h3>
                <select class="cursor-pointer mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="selectedCategory" @change="fetchByCategory">
                    <option :value="null" v-if="categoriesList === null">No Data</option>
                    <option v-for="category in categoriesList" :key="category.id" :value="category.id" :selected="category.id === selectedCategory">{{ category.name }}</option>
                </select>
            </div>
        </div>
    <div class="py-16 container mx-auto">
        <h3 class="font-bold text-xl mb-8">List of Products</h3>
        <button class="outline-none inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none mb-12" @click="openModal = true">
            Add Product
        </button>
      <!-- modal here -->
        <div v-if="openModal" class="fixed overflow-x-hidden overflow-y-auto inset-0 flex justify-center items-center z-50">
            <div class="relative mx-auto w-auto max-w-2xl">
                <div class="bg-white w-auto rounded-md px-4 py-6">
                    <span class="float-right font-bold text-xl -mt-3 mr-2 cursor-pointer hover:text-gray-700" @click="close">&#10005;</span>
                    <h3 class="pb-3 font-bold text-xl">Add New Product</h3>
                <label for="" class="py-4 text-lg mb-4">Product Name</label>
                <input class="w-full h-10 px-4 text-lg text-gray-700 placeholder-gray-600 border border-gray-500 rounded-lg mb-4 outline-none" type="text" v-model="newItem.name" placeholder="Product Name ..."/>
                <label for="" class="py-4 text-lg mb-4">Price</label>
                <input class="w-full h-10 px-4 text-lg text-gray-700 placeholder-gray-600 border border-gray-500 rounded-lg mb-4 outline-none" type="number" v-model="newItem.price" placeholder="Price ..."/>
                <label for="" class="py-4 text-lg mb-4">Category</label>
                <select class="cursor-pointer mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="newItem.category">
                    <option :value="null" v-if="categoriesList === 0">No Categories found</option>
                    <option v-for="category in categoriesList" :key="category.id" :value="category.id" :selected="category.id === selectedCategory">{{ category.name }}</option>
                </select>
                <label for="" class="py-4 text-lg mb-4">Description</label>
                <textarea class="w-full h-25 px-3 py-2 text-base outline-none text-gray-700 border-gray-500 placeholder-gray-600 border rounded-lg mb-4" v-model="newItem.description" placeholder="Description ..."></textarea>
                <label for="" class="py-4 text-lg mb-4">Image</label>
                <input class="w-full mb-8 cursor-pointer" ref="category_image" type="file"  @change="onFileSelected"/>
                <div class=" px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" @click="save">
                        Save
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="close">
                        Cancel
                    </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="openModal" class="absolute inset-0 z-40 opacity-25 bg-black"></div>
      <!-- end modal here -->

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" @click="sort('name')">
                    Product Name <span>&#8597;</span>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" @click="sort('price')">
                  Price <span>&#8597;</span>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Category
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="product in sortedProducts" :key="product.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ product.name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ product.description }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ product.price }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ product.category }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-12 w-12">
                        <img class="h-12 w-12 rounded-full" v-if="product.image" :src="product.image" alt="">
                      </div>
                    </div>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

        </div>
    <!-- pagination here -->
    <pagination :meta="meta" @pagination="getProductsList"></pagination>
    <!-- end pagination here -->
    <footer class="py-12 mt-20 bg-gray-800">


        <p class="text-center w-4/5 py-5 m-auto border-t-2 border-gray-700 text-gray-100 text-sm">All Right Reserved {{ new Date().getFullYear() }} </p>
    </footer> <!-- end product page here -->
    </div>
    </div>
</template>

<script>
import PaginationComponent from './components/PaginationComponent.vue';
export default {
  components: { PaginationComponent },
    name: 'App',
    data () {
        return {
            openModal: false,
            categoriesList: [],
            products: [],
            sortBy: 'name',
            sortDirection: 'asc',
            meta: {
                current_page: '',
                from: '',
                last_page: '',
                to: '',
                total: '',
            },
            newItem: {
                name: '',
                description: '',
                price: undefined,
                image: null,
                category: 0,
            },
            selectedCategory: null,

        }
    },
    mounted () {
        this.getCategoriesList();
        this.getProductsList();
    },
    computed: {
        sortedProducts(){
                return this.products.sort((p1,p2) => {
                    let modifier = 1;
                    if(this.sortDirection === 'desc') modifier = -1;
                    if(p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier; if(p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
                    return 0;
                });
            }
    },
    methods: {
        getCategoriesList() {
            axios.get('/api/categories').then(
                (res) => {
                    this.categoriesList = res.data;
                });
        },
        getProductsList(page) {
            axios.get('/api/products', {
                params: {
                    page
                }
            }).then(
                (res) => {
                    this.products = res.data.data;
                    this.meta.current_page = res.data.current_page;
                    this.meta.from = res.data.from;
                    this.meta.last_page = res.data.last_page;
                    this.meta.to = res.data.to;
                    this.meta.total = res.data.total;
                });
        },
        sort(s){
                if(s === this.sortBy) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                }
                this.sortBy = s;
            },
        close() {
            this.openModal = false
        },
        onFileSelected() {
            this.newItem.image = this.$refs.category_image.files[0]
        },
        save() {
            let fd = new FormData();
            fd.append("name", this.newItem.name);
            fd.append("description", this.newItem.description);
            fd.append("price", this.newItem.price);
            fd.append("category_id", this.newItem.category);
            fd.append("image", this.newItem.image);

            axios.post('/api/products', fd, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((res) => {
                console.log(res);
                this.products.push(res.data);
            });

            this.close();
        },
        fetchByCategory() {
            if (this.selectedCategory !== null) {
                axios.get(`/api/products/category/${this.selectedCategory}`)
                .then((res) => {
                    this.products = res.data.data;
                    console.log(this.selectedCategory);
                });
            }
        },
    }
}
</script>
