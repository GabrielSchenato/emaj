<template>
    <v-toolbar color="primary" fixed dark app>
        <v-toolbar-title class="ml-0 pl-3">
            <v-toolbar-side-icon @click.stop="handleDrawerToggle"></v-toolbar-side-icon>
        </v-toolbar-title>
        <!--     <v-text-field
              flat
              solo-inverted
              prepend-inner-icon="search"
              label="Buscar..."
              class="hidden-sm-and-down"
              clearable
            ></v-text-field> -->
        <v-spacer></v-spacer>
        <v-btn icon @click="handleFullScreen()">
            <v-icon>fullscreen</v-icon>
        </v-btn>
        <v-menu
            offset-y
            origin="center center"
            class="elelvation-1"
            :nudge-bottom="14"
            transition="scale-transition"
            >
            <!-- <v-btn icon flat slot="activator">
              <v-badge color="red" overlap>
                <span slot="badge">3</span>
                <v-icon medium>notifications</v-icon>
              </v-badge>
            </v-btn>
            <notification-list></notification-list> -->
        </v-menu>
        <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
            <v-btn icon large flat slot="activator">
                <v-avatar size="30px">
                    <img v-bind:src="getAvatar" v-bind:alt="$auth.user().nome_completo">
                </v-avatar>
            </v-btn>

            <v-list class="pa-0">
                <v-list>
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img v-bind:src="getAvatar" v-bind:alt="$auth.user().nome_completo">
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title>{{ $auth.user().nome_completo }}</v-list-tile-title>
                            <v-list-tile-sub-title>{{ $auth.user().role | formataRole }}</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>

                <v-list-tile
                    href="#/perfil"
                    ripple="ripple"
                    rel="noopener"
                    >
                    <v-list-tile-action>
                        <v-icon>account_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Perfil</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>


                <v-list-tile
                    @click.prevent="logout"
                    ripple="ripple"
                    rel="noopener"
                    >
                    <v-list-tile-action>
                        <v-icon>exit_to_app</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Sair</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

            </v-list>
        </v-menu>
    </v-toolbar>
</template>
<script>
//import NotificationList from "@/components/widgets/list/NotificationList";
    import Util from "@/util";
    export default {
        name: "app-toolbar",
        components: {
            //NotificationList
        },
        data: () => ({
            }),
        computed: {
            toolbarColor() {
                return this.$vuetify.options.extra.mainNav;
            },
            getAvatar(){
                if(this.$auth.ready()){
                    if(this.$auth.user().avatar)
                        return 'data:image/jpeg;base64,' + this.$auth.user().avatar;
                    return null;
                }
            }
        },
        methods: {
            handleDrawerToggle() {
                window.getApp.$emit("APP_DRAWER_TOGGLED");
            },
            handleFullScreen() {
                Util.toggleFullScreen();
            },
            logout() {
                this.$auth.logout();
                window.getApp.$emit("APP_LOGOUT");
            }
        }
    };
</script>
