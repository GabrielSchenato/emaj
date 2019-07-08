<template>
  <div id="appRoot">
    <template v-if="!$route.meta.public">
      <v-app id="inspire" class="app">
        <app-drawer class="app--drawer"></app-drawer>
        <app-toolbar class="app--toolbar"></app-toolbar>
        <v-content>
          <!-- Page Header -->
          <page-header v-if="$route.meta.breadcrumb"></page-header>
          <div class="page-wrapper">
            <router-view></router-view>
          </div>   
           <!-- App Footer -->
          <v-footer height="auto" class="white pa-3 app--footer">
            <span class="caption">&copy; {{ new Date().getFullYear() }}</span>
            <v-spacer></v-spacer>
            <span class="caption mr-1"> Desenvolvido por: <span class="">Gabriel Schenato</span> </span>
          </v-footer>
        </v-content>
        <!-- Go to top -->
        <app-fab></app-fab>
        <v-navigation-drawer
          class="setting-drawer"
          temporary
          right
          v-model="rightDrawer"
          hide-overlay
          fixed
          >
        </v-navigation-drawer>        
      </v-app>
    </template>
    <template v-else>
      <transition>
        <keep-alive>
          <router-view :key="$route.fullpath"></router-view>
        </keep-alive>
      </transition>
    </template>
    <v-snackbar
      :timeout="snackbar.timeout"
      auto-height
      top
      right
      multi-line
      :color="snackbar.color"
      v-model="snackbar.show"
      v-bind:style="{ zIndex: 2000 }"
    >
      <v-icon dark>{{ snackbar.icon }}</v-icon>
        <div id="text-snackbar">&nbsp; {{ snackbar.text }}</div>
      <v-btn dark flat @click.native="snackbar.show = false" icon> 
        <v-icon>close</v-icon>
      </v-btn>
    </v-snackbar>
    <div id="preloader" v-if="loader.show || counter !== 0 && $auth.ready()">
        <div id="ftco-loader" class="show">
            <div class="loader">{{ loader.msg }}</div>
        </div>      
    </div>
  </div>
</template>
<script>
import AppDrawer from '@/components/AppDrawer';
import AppToolbar from '@/components/AppToolbar';
import AppFab from '@/components/AppFab';
import PageHeader from '@/components/PageHeader';
import AppEvents from  './event';
import axios from 'axios';
export default {
  components: {
    AppDrawer,
    AppToolbar,
    AppFab,
    PageHeader,
  },
  data: () => ({
    expanded: true,
    rightDrawer: false,
    counter: 0,
    snackbar: {
      show: false,
      text: '',
      color: '',
      timeout: 3000,
      icon: ''
    },
    loader: {
        show: false,
        msg: 'Carregando...'
    }
  }),

  computed: {

  },

  created () {
    AppEvents.forEach(item => {
      this.$on(item.name, item.callback);
    });
    window.getApp = this;
  },
  methods: {
    openThemeSettings () {
      this.$vuetify.goTo(0);
      this.rightDrawer = (!this.rightDrawer);
    }
  },
    mounted() {
      axios.interceptors.request.use((config) => {
          this.counter ++;
          return config;
      }, (error) => {
          return Promise.reject(error);
      });
      axios.interceptors.response.use((config) => {
          this.counter --;
          return config;
      }, (error) => {
          this.counter --;
          return Promise.reject(error);
      });
  }

};
</script>


<style lang="stylus" scoped>
  .setting-fab 
    top:50%!important; 
    right:0;
    border-radius:0  
  .page-wrapper
    min-height:calc(100vh - 64px - 50px - 81px );  
</style>

<style>
    #text-snackbar {
           padding-left: 10px;
           text-align: center;
    }
    #preloader {
            background: rgba(255, 255, 255, 0.5);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 99999;
    }
    .loader {
            width: 250px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-family: helvetica, arial, sans-serif;
            text-transform: uppercase;
            font-weight: 900;
            color: #11589e;
            letter-spacing: 0.2em;
    }

    .loader::before,
    .loader::after {
            content: "";
            display: block;
            width: 15px;
            height: 15px;
            background: #11589e;
            position: absolute;
            -webkit-animation: load .7s infinite alternate ease-in-out;
            animation: load .7s infinite alternate ease-in-out;
    }

    .loader::before {
            top: 0;
    }

    .loader::after {
            bottom: 0;
    }

    @-webkit-keyframes load {
            0% {
                    left: 0;
                    height: 30px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 40px;
            }
            100% {
                    left: 235px;
                    height: 30px;
                    width: 15px;
            }
    }

    @keyframes load {
            0% {
                    left: 0;
                    height: 30px;
                    width: 15px;
            }
            50% {
                    height: 8px;
                    width: 40px;
            }
            100% {
                    left: 235px;
                    height: 30px;
                    width: 15px;
            }
    }
</style>