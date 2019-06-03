<template>
    <div class="col-md-8">
        v-if(path)
                        <img class="img-fluid" v-bind:src="'storage/' + path" alt="">
                        
                   
    
        <div>
            <input type="file" @change="processFile($event)" multiple>
            <input type="file" @change="previewFiles" multiple>
            
        </div>
        <div>
            <button class="btn" v-on:click="upload"> </button>
        </div>
    </div>
</template>



<script>
    export default {
        
    data: function() {
            return {
            	path: null,
            	image: []
            }
        },
        mounted() {
            this.update()
        },
        methods: {
            update: function() {
            	//console.log(this.initialCartProducts);
            
            },
            processFile(event) {
                //this.image = event.target.files[0];
            },
            previewFiles(event) {
                this.image = event.target.files;
                console.log(event.target.files);
            },
            /*
            upload: function() {
                axios.get('/image-upload')
            		.then((response) => {
                    	console.log(response);
                    
                    	//this.resp = response;
                    })
                    .catch(e => {
                    	console.log(e);
                    });
            },
            */
            upload: function() {
                axios({
                    method: 'get',
                    url: '/image-upload',
                    params: {image: this.image}
                })
            		.then((response) => {
                    	console.log(response);
                    
                    	//this.resp = response;
                    })
                    .catch(e => {
                    	console.log(e);
                    });
            }
        }
    }
</script>
