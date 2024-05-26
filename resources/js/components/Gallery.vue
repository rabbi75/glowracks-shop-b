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
                    <li><a>Gallery</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-section">	
			<div class="container">
				<div class="row">
					<div class="col-sm-4" v-for="(value,gallery) in galleris">	
						<div class="gallery">
							<img :src="value.image" alt="">	
							<p>{{value.name}}</p>
							<p>	Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat, architecto quo nostrum libero </p>
						</div>
					</div>
				</div>
			</div>			
    </div>	
	</div>	
</template>

<script>
 import sidebar from '../components/includes/sidebar';
    export default {
        components: {
            sidebar,
        },
        data(){
            return {
                galleris: [],
            }
        },
        methods:{
            loadGallery(){
                axios.get('/api/v1/gallery').then(response => {
                    this.galleris = response.data.galleris;
                });
            }
        },
        mounted(){
            this.loadGallery();
        }
    }
</script>