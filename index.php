
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
    <style>
        div.wrapper{
            width: 60%;
            margin: auto;
        }
        div.progress-bar{
            background: #e3e3e3;
            height: 20px;
            border-radius: 3px;
        }
        div.progress-bar>div{
            height: 100%;
            background: #759dff;
            border-radius:inherit;
            transition: 1s;
        }

        label{
            width: 100%;
        }


    </style>
</head>
<body>
<div class="wrapper">
    <hr>
    <div class="sample">
        <form method="post" action="index.php" @submit.prevent="isVisibleForm = !isVisibleForm">
            <div class="progress-bar"><div :style="progressBar"></div></div>
            <label class="label">
                Name <i :style="colorName.name" :class="className.name"></i>
                <input v-model = 'sendData.name' @input="nameFunc" type = "text" name = "name" class="form-control" placeholder="Username">
            </label>
            <label class="label">
                Phone <i :style="colorName.phone" :class="className.phone"></i>
                <input v-model = 'sendData.phone' @input="nameFunc" type = "text" name = "phone" class="form-control" placeholder="Phone">
            </label>
            <label class="label">
                Email <i  :style="colorName.email" :class="className.email"></i>
                <input v-model = 'sendData.email' @input="nameFunc" type = "text" name = "email" class="form-control" placeholder="Email">
            </label>
            <label class="Message">
                Message <i  :style="colorName.message" :class="className.message"></i>
                <textarea v-model = 'sendData.message' @input="nameFunc" name = "message" class="form-control" placeholder="Message"></textarea>
            </label>
            <button class="btn btn-primary" :disabled='isDisabledButton' type="submit">Send Data</button>
        </form>
        <div v-else class = "answer">
            <table class = "table table-bordered">
                <tr v-for=" (value, key) in sendData ">
                    <td>{{key}}</td>
                    <td>{{value}}</td>
                </tr>

            </table>
        </div>
    </div>

</div>
<script>

    var newVue = new Vue({
        el: '.sample',
        data: {
            isVisibleForm:true,

            progressBar:{
                width:'0%'
            },

            isDisabledButton:true,
            icon: {
                yes:{
                    class: 'fa fa-check-circle',
                    color: 'green'
                },
                no:{
                    class: 'fa fa-exclamation-circle',
                    color: 'red'
                }
            },
            className:{
                name:'',
                phone:'',
                email:'',
                message:''
            },

            colorName:{
                name:{color:''},
                phone:{color:''},
                email:{color:''},
                message:{color:''}
            },

            sendData:{
                name:'',
                phone:'',
                email:'',
                message:''
            },
            checkData:{
                name: new RegExp('.+'),
                phone: new RegExp('^[0-9]{7,11}$'),
                email: new RegExp('^([a-z0-9_-]+\\.)*[a-z0-9_-]+@[a-z0-9_-]+(\\.[a-z0-9_-]+)*\\.[a-z]{2,6}$'),
                message: new RegExp('.+')
            },
            isVisible:{
                name: false,
                phone: false,
                email: false,
                message: false
            }
        },
        methods:{
           nameFunc(event){
               var attr = event.target.getAttribute('name');
                if (this.isTrue(this.checkData[attr],this.sendData[attr])){
                    this.className[attr] = this.icon.yes.class;
                    this.colorName[attr] = this.icon.yes;
                    this.isVisible[attr] = true;
                } else {
                    this.className[attr] = this.icon.no.class;
                    this.colorName[attr] = this.icon.no;
                    this.isVisible[attr] = false;
                }
               this.openCloseButton();
               this.getProgressBar();
            },

            isTrue(reg,str){
                return reg.test(str);
            },

            openCloseButton(){
               if (this.isVisible.name && this.isVisible.phone &&
                   this.isVisible.email && this.isVisible.message){
                   this.isDisabledButton = false;
               } else this.isDisabledButton = true;

            },

            getProgressBar(){
               var sum = 0;
                for (key in this.isVisible){
                    sum += this.isVisible[key];
                }
                this.progressBar.width = sum*100/4 + '%';
            }


        }
    });

</script>
</body>
</html>
