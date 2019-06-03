<template>
    <div class="container">
        <div class="progress" style="height: 40px">
            <div class="progress-bar" role="progressbar" :style="{ width: fileProgress + '%'}">
                {{ fileCurrent }}%
            </div>
        </div>
        <hr>
        <input type="file" name="image" multiple="" @change="fileInputChange">
        <hr>
        
        <div class="col-sm-6">
            <h3 class="text-center">Файлы в очереди ({{ filesInOrder.length }})</h3>
            <ul class="list-group">
                <li class="list-group-item" v-for="file in filesInOrder">
                    {{ file.name }} : {{ file.type }}
                </li>
            </ul>
        </div>
        
        <div class="col-sm-6">
            <h3 class="text-center">Загруженные файлы ({{ filesFinish.length }})</h3>
            <ul class="list-group">
                <li class="list-group-item" v-for="file in filesFinish">
                    {{ file.name }} : {{ file.type }}
                </li>
            </ul>
        </div>
        
    </div>
</template>

<script>
    export default {
        data: function() {
            return{
                //Список файлов для загрузки
                filesInOrder: [],
                //Список уже загруженных файлов
                filesFinish: [],
                //Процент загрузки файлов на сервер
                fileProgress: 0,
                fileCurrent: ''
            }
        },
        mounted() {
            
        },
        methods: {
            async fileInputChange(event) {
                //Список файлов для загрузки, преобразованный в массив
                let files = Array.from(event.target.files);
                //Присваиваем копию массива - нельзя просто присваивать this.filesInOrder = files; 
                //Иначе будут проблемы с очередями!!!
                this.filesInOrder = files.slice();
                
                for ( let item of files) {
                    //await - приостанавливает выполнение функции uploadFile() до получения ей резулттата
                    await this.uploadFile(item);
                }
            },
            async uploadFile(item) {
                let form = new FormData();
                form.append('image', item);
                
                await axios.post('/a7dm0in3/image-upload', form, {
                    onUploadProgress: (itemUpload) => {
                        this.fileProgress = Math.round((itemUpload.loader / itemUpload.total) * 100);
                        this.fileCurrent = item.name + ' ' + item.fileProgress;
                    }
                })
                .then(response => {
                    this.fileProgress = 0;
                    this.fileCurrent = '';
                    this.filesFinish.push(item);
                    //Удаление из очереди
                    this.filesInOrder.splice(item, 1);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>