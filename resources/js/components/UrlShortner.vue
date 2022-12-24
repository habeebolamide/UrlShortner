<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="shortner">
          <div class="section-heading text-center">
            <h1>Url Shortner</h1>
            <br />
            <div class="py-2" align="center">
              <div class="pageIntroDescription border border-info p-3 mb-0">
                Professional Url Shortner
              </div>
            </div>

            <div v-if="AuthorizedUser">
              <form action="" @submit.prevent="shortenUrl" class="form mt-4">
                <div class="input-group">
                  <input
                    type="text"
                    id="p1"
                    v-model="form.url"
                    class="form-control"
                    placeholder="Put Url Here"
                  />
                </div>
                <div>
                  <button class=" btn btn-dark mt-3">Process</button>
                </div>
              </form>

              <p v-if="!urlNotFound"  class="alert alert-danger mt-4">
                    Url not Valid
              </p>

              <button class="process btn btn-info copyLink mb-5 mt-5"  @click.prevent="copyContent">
                <span id="output_url">
                    <span >
                        {{ copyTextString }}
                    </span>
                </span>
              </button>
              
            </div>
            <div v-else>
                <h5>Go and Login</h5>
                <hr>
                <a href="/register">
                    <small>
                        Register Here
                    </small>
                </a>
                or
                <a href="/login">
                    <small>
                        Login Here
                    </small>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<!-- <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script> -->
<script>
import axios from 'axios';
import Clipboard from 'clipboard';

export default {
  props : {
      AuthorizedUser : String || Array,
  },

  data() {
    return {
      form: {},
      urlNotFound : true,
      copyTextString : "Copy Text To Clipboard",
      res:null
    };
  },
  methods: {
    shortenUrl() {
        let self = this;
        let newUrl = this.form.url;
        let newArray = newUrl.split("//")
        let counter = 0;
        let resultnewUrl = Math.round((Math.pow(36,8) - Math.random()  * Math.pow(36,8))).toString(36).slice(1)
        for (let index = 0; index < newArray.length; index++) {
                if (newArray[index] == "http:" || newArray[index] == "https:") {
                    counter++ 
                }    
                if (counter == 0) {
                    let  newArrayOne = newUrl.split(".") 

                    if (newArrayOne [index] == "www") {
                        counter++
                    }

                    let newArrayTwo = newUrl.indexOf(".com");

                    if( newArrayTwo >= 0 ){
                        counter++
                    }
                }  
                if (counter == 0) {
                    this.form.url = false;
                }   else{
                    let CurrentUrl = window.location.href + "url/u/"+resultnewUrl

                    axios.post('url/shorten',{
                        url:newUrl,
                        shortlink:CurrentUrl
                    }).then((res) => {
                        // console.log(res);
                        this.res = res.data
                        $('.copyLink').fadeIn(500); 
                        this.form.url = this.res
                        // console.log(this.url);
                    })
                }      
        }
        // console.log(resultnewUrl);
        var rest = document.getElementById('p1').value
        rest = null;
    },
   
        copyContent() {
    const el = document.createElement('textarea');
    el.value = this.form.url;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    this.copyTextString = "Copied!"
    }
    }
  }
</script>
<style scoped>
    .copyLink{
        display: none;
        margin-top: 200px;
    }
    #clipBoard{
        display: block;
        background: #03cbf8;
        color: white;
        font-weight: 900;
        font-size: 17px;
    }
    #clipBoard:hover{
        background: #333;
    }
    #clipBoard:visited, #clipBoard:active,#clipBoard:focus{
        background: green;
        color:#333 ;
    }
</style>