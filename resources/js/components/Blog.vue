<template>
    <div>
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                        <sidebar></sidebar>
                        <li><router-link :to="{name:'home'}"><i class="fa fa-home"></i> Home</router-link></li>
                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                        <li><a>Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    	<section class="recomandate-section section-padding">
         <div class="container">
          <div class="row">
            <div class="col-md-9 col-sm-9">
              <div class="row light_bg">
                <div class="col-lg-6" v-for="value in blogs" :key="value.id">
                  <div class="blog-inner">
                    <div class="image">
                     <router-link :to="{name:'blogdetails',params:{id:value.id,slug:value.slug}}">
                        <img :src="value.image" class="img-responsive" alt="">
                     </router-link>
                    </div>
                    <div class="title">
                      <router-link :to="{name:'blogdetails',params:{id:value.id,slug:value.slug}}">{{value.title}}</router-link>
                    </div>
                    
                    <div class="blog-sdetails">
                     <p>{{ value.description.substring(0,100)+".." }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="blog-category">
                 <h5>Categories</h5>
                 <div class="category-item" v-for="(bcateogry,index) in blogcategories" >
                    <router-link :to="{name:'blogcategory', params:{slug:bcateogry.slug}}">
                      {{bcateogry.name}}
                   </router-link>

                 </div>
               </div>
               <div class="blog-product">
                 <h5>Latest Blog</h5>
                <div class="row" v-for="lvalue in latestblog" :key="lvalue.id">
                <div class="col-lg-12 col-md-12 col-sm-12 recomanded-product-inner">
                  <div class="recomanded-product blog-recomanded-product">
                    <div class="image">
                           <img :src="lvalue.image" alt="">
                    </div>
                    <div class="content">
                      <div class="name">
                        <router-link :to="{name:'blogdetails',params:{id:lvalue.id,slug:lvalue.slug}}">{{lvalue.title.substring(0,25)+".."}}</router-link>
                      </div>
                      <div class="price">
                        <p> {{ lvalue.created_at }}</p>
                      </div>
                      
                    </div>
                  </div>
                </div>
                </div>
               </div>
            </div>
          </div>
          </div>
        </section>

    </div>
</template>
<script>
    import sidebar from '../components/includes/sidebar'
    export default {
        components: {
            sidebar,
        },
        data(){
            return {
                blogs: [],
                blogcategories: [],
                latestblog: [],
            }
        },
        methods:{
            loadDate(){
                axios.get('/api/v1/blog').then(response => {
                    this.blogs = response.data.blogs;
                });
                axios.get('/api/v1/blog/category').then(response => {
                    this.blogcategories = response.data.blogcategories;
                });
                axios.get('/api/v1/latest/blog').then(response => {
                    this.latestblog = response.data.latestblog;
                });
            }
        },
        mounted(){
            this.loadDate();
        }
    }
</script>