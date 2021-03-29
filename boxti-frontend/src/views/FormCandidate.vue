<template>
  <v-card style="margin: 40px 50px 40px 50px; background-color: #f3f3f3">
    <v-card-title>
      <span class="headline" style="color: #244873">Formulário de Técnico</span>
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="candidate.name"
              :rules="requiredRules"
              label="Nome do técnico"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="candidate.cpf"
              :rules="cpfRules"
              :counter="11"
              label="CPF do técnico"
              hint="Somente números"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="candidate.email"
              :rules="requiredRules"
              label="Email do técnico"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-dialog
            ref="dialog"
            v-model="modal"
            :return-value.sync="date"
            persistent
            width="290px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="candidate.date_birth"
                label="Data de nascimento do técnico"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
                :rules="requiredRules"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="date"
              scrollable
              :first-day-of-week="0"
              locale="pt-br"
              no-title
            >
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="modal = false">
                Cancelar
              </v-btn>
              <v-btn text color="primary" @click="$refs.dialog.save(date)">
                OK
              </v-btn>
            </v-date-picker>
          </v-dialog>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="candidate.address"
              :rules="requiredRules"
              label="Endereço do técnico"
              hint="Logradouro, número"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
            <v-select
          v-model="candidate.stacks"
          :items="stacks"
          :item-text="'name'"
          :item-value="'name'"
          label="Selecione quais você tem conhecimento"
          multiple
          chips
          hint="Quais são seus conhecimentos"
          persistent-hint
        ></v-select>
        </v-row>
        <v-row align="center" justify="space-around" style="margin-top: 60px; margin-bottom: 40px;">
            <v-btn
              color="success"
              dark
              large
              @click="saveCandidate()"
            >
              Salvar
            </v-btn>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from "axios"
export default {
  name: "FormCandidate",
  data() {
    return {
      stacks: [],
      candidate: {},
      cpfRules: [
        (v) => !!v || "Este campo é obrigatório",
        (v) => v.length <= 11 || "Máximo 11 números",
        (v) => /^\d+$/.test(v) || "Este campo aceita somente números",
      ],
      requiredRules: [(v) => !!v || "Este campo é obrigatório"],
      date: new Date().toISOString().substr(0, 10),
      modal: false,
    };
  },
  created() {
    this.getStacks()
  },
  watch: {
    date() {
      this.candidate.date_birth = this.formatDate(this.date);
    },
  },

  methods: {
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    },
    getStacks() {
      axios
      .request({
        baseURL: "http://localhost:8000",
        method: "get",
        url: "/api/stacks/"
      })
      .then(response => {
        this.stacks = response.data
      });
    },
    saveCandidate() {
        axios
        .post("http://localhost:8000/api/candidates/", this.candidate)
            .then(response => {
                this.log.console(response)
            })
            .catch((error) => {
                alert(error.response.data.error);
            });
    }
  },
};
</script>
