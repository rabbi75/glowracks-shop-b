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
                        <li><router-link :to="{name:'blog'}">Blog</router-link></li>
                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                        <li><a>{{details.title}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="recomandate-section section-padding">
        <div class="container">
          <div class="row light_bg">
            <div class="col-md-9 col-sm-9">
              <div class="row">
            <div class="col-lg-12">
              <div class="details-blog-inner">
                <div class="image">
                 <a href="">
                    <img :src="details.image" class="img-responsive" alt="">
                 </a>
                </div>
                <div class="detials-title">
                  <a href="">{{details.title}}</a>
                </div>
                <div class="blog-admin">
                  <img src="public/uploads/avatar/avatar.png" alt="" class="image">
                  <span class="admin-name">Admin</span>
                  <span class="entry-date">{{details.created_at}}</span>
                </div>
                <div class="blog-sdetails">
                 {{details.description}}
                </div>
              </div>
            </div>
          </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="blog-category">
                 <h5>Categories</h5>
                 <div class="category-item" v-for="(bcateogry,index) in blogcategories" >
                   <a href="">{{bcateogry.name}}</a>
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
                details: {},
                blogcategories: [],
                latestblog: [],
            }
        },
        methods:{
            loadData(){
                let id = this.$route.params.id;
                let slug = this.$route.params.slug;
                axios.get('/api/v1/blog/details/'+id+'/'+slug).then(response => {
                     this.details = response.data.details;
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
            this.loadData();
        }
    }
</script>