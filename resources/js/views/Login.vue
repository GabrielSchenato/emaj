<template>
  <v-app id="login" class="primary">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4 lg4>
            <v-card class="elevation-1 pa-3" id="painel">
              <v-card-text>
                <div class="layout column align-center">
                  <img src="/images/logo_preta.png" alt="EMAJ" width="120" height="120">
                  <h1 class="flex my-4 primary--text">EMAJ</h1>
                </div>
                <v-form>
                  <v-text-field
                    append-icon="person"
                    name="login"
                    label="E-mail"
                    type="email"
                    v-model="model.username"
                  ></v-text-field>
                  <v-text-field
                    append-icon="lock"
                    name="password"
                    label="Senha"
                    id="password"
                    type="password"
                    v-model="model.password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <a href="">Esqueceu sua senha?</a>
                <v-spacer></v-spacer>
                <v-btn outline block color="primary" @click="login" :loading="loading">Entrar
                  <v-icon right dark>keyboard_tab</v-icon>
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    loading: false,
    model: {
      username: "gabriel@uniplaclages.edu.br",
      password: "password"
    }
  }),

  methods: {
    login() {
      this.loading = true;
      setTimeout(() => {
        this.$router.push("/dashboard");
      }, 1000);
    }
  }
};
</script>
<style scoped lang="css">
#login {
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  content: "";
  z-index: 0;
  background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)),
    url("/images/bg_1.jpg");
}

#painel {
  background: linear-gradient(rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0.45));
  color: white;
}
</style>
