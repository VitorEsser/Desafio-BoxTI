<template>
  <v-container>
    <v-card>
      <v-card-title>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Pesquisar na tabela"
          single-line
          hide-details
          style="margin-bottom: 13px !important"
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-select
          v-model="searchStacks"
          :items="stacks"
          :item-text="'name'"
          :item-value="'name'"
          label="Selecione os conhecimentos que deseja filtrar"
          multiple
          chips
        >
          <template v-slot:selection="{ item, index }">
            <v-chip v-if="index === 0">
              <span>{{ item.name }}</span>
            </v-chip>
            <span v-if="index === 1" class="grey--text caption">
              (+{{ searchStacks.length - 1 }} outros)
            </span>
          </template>
        </v-select>
        <v-spacer></v-spacer>
        <v-btn color="#244873" dark large @click="searchCandidate()">
          <v-icon
            class="ma-2"
            text
            icon
            color="white"
            >mdi-magnify</v-icon
          >
        </v-btn>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="candidates"
        :search="search"
        no-results-text="Nenhum resultado encontrado"
        :hide-default-footer="true"
      >
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon
            class="ma-2"
            text
            icon
            color="#C73232"
            @click="deleteCandidate(item)"
            >mdi-delete</v-icon
          >
          <v-icon
            class="ma-2"
            text
            icon
            color="#244873"
            @click="editCandidate(item.id)"
            >mdi-pencil</v-icon
          >
        </template>
      </v-data-table>
    </v-card>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  name: "ListCandidate",
  data() {
    return {
      search: "",
      candidates: [],
      stacks: [],
      searchStacks: [],
      searchInput: "",
      headers: [
        { text: "Código", align: "center", sortable: false, value: "id" },
        { text: "Nome", align: "start", sortable: false, value: "name" },
        { text: "CPF", align: "end", sortable: false, value: "cpf" },
        { text: "E-mail", align: "start", sortable: false, value: "email" },
        {
          text: "Criado em",
          align: "center",
          sortable: false,
          value: "created_at",
        },
        { text: "Ações", align: "center", sortable: false, value: "actions" },
      ],
    };
  },
  created() {
    this.getCandidates();
    this.getStacks();
  },
  methods: {
    getCandidates() {
      axios
        .request({
          baseURL: "http://localhost:8000",
          method: "get",
          url: "/api/candidates/",
        })
        .then((response) => {
          this.candidates = response.data;
          this.parseDate();
        });
    },
    getStacks() {
      axios
        .request({
          baseURL: "http://localhost:8000",
          method: "get",
          url: "/api/stacks/",
        })
        .then((response) => {
          this.stacks = response.data;
        });
    },
    searchCandidate() {
      if (this.searchStacks.length > 0) {
        axios
        .post("http://localhost:8000/api/candidates/search", this.searchStacks)
            .then(response => {
                this.candidates = response.data;
            })
      } else {
        this.getCandidates()
      }
    },
    parseDate() {
      this.candidates.forEach((candidate) => {
        let dateSplit = candidate.created_at.split(" ");
        candidate.created_at = dateSplit[0] + " às " + dateSplit[1];
      });
    },
    deleteCandidate(candidate) {
      if (confirm("Excluir " + candidate.name)) {
        axios
          .delete(`http://localhost:8000/api/candidates/${candidate.id}`)
          .then((response) => {
            this.getCandidates();
            console.log(response);
          });
      }
    },
    editCandidate(candidateID) {
      this.$router.push({ name: "EditCandidate", params: { id: candidateID } });
    },
  },
};
</script>