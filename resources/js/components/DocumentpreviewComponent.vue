<template>
  <div class="content-wrapper is-add_style">
    <div class="main_content p-setting">
      <div class="is-body_content">
        <h1 class="is-body_content__title">プレビュー</h1>
        <div class="is-body_content__preview">
          <div class="p-preview__content">
            <div class="p-preview__content__btn">
                <div class="d-flex justify-content-start">
                    <button type="button" class="o-btn is-white" style="margin: 0; width:100px" v-on:click="onbacklist" v-if="preview_type != 1">一覧へ戻る</button>
                    <button type="button" class="o-btn" style="margin: 0 5px 0 auto; width:100px" v-on:click="editbutton">編集<span v-if="preview_type == 1">に戻る</span></button>
                    <button type="button" class="o-btn"  style="margin: 0 5px 0 0; width:100px" v-if="preview_type != 1" v-on:click="sendmail">メール</button>
                    <button type="button" class="o-btn" style="margin: 0 5px 0 0; width:100px" v-on:click="submit()" v-if="preview_type == 1">保存</button>
                    <!-- <button type="button" class="o-btn p-2 bd-highlight w-auto" onclick="window.print();">印刷</button> -->
                    <!-- <button type="button" class="o-btn"  style="margin: 0 5px 0 0; width:100px" v-on:click="downloadPDF()">ダウンロード</button> -->
                    <!-- <button type="button" class="o-btn"  style="margin: 0 5px 0 0; width:100px">ダウンロード</button> -->
                </div>
            </div>
            <div class="p-preview__content__detail">
                <iframe :src="pdffile_path" width="100%" height="1200px"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pdfMake from "pdfmake/build/pdfmake";
import "../vfs_fonts";
import moment from "moment";
moment.locale("ja");
export default {
  data() {
    return {
      pdffile_path: "",
      pdfDocGenerator: null,
      company_logo_base64: null,
      doc_info: null,
      product_item: null,
      postage_item: null,
      doc_type_in_txt: "",
      tableData: [],
      total_price: 0,
      total_tax: 0,
      user: [],
      preview_type: 0
    };
  },
  mounted: function() {
    this.getInfo();
    this.$router.afterEach((to, from) => {
      if((beforeTo.path == to.path) && (beforeFrom.path == from.path)){
        console.log("return");
        return;
      }
      else {
        if(from.path == "/preview" && this.preview_type == 1 && to.path != "/create-doc" && to.path != "/doc-list"){
          beforeTo = to;
          beforeFrom = from;
          window.confirm("保存してませんがこのページを離れますか？") ? this.$router.push({name: to.name}).catch(err => {}) : this.$router.push({name: from.name, params: { 
                doc_info: this.$route.params.doc_info,
                product_item: this.$route.params.product_item,
                postage_item: this.$route.params.postage_item,
                remarks: this.$route.params.remarks }});
        }
        if(from.path == "/preview" && this.preview_type == 1 && (to.path == "/doc-list" || to.path == "/create-doc")){
          beforeTo = to;
          beforeFrom = from;
          this.$router.push({name: to.name, params: { 
                doc_info: this.$route.params.doc_info,
                product_item: this.$route.params.product_item,
                postage_item: this.$route.params.postage_item,
                remarks: this.$route.params.remarks }}).catch(err => {});
        }
        if(from.path == "/preview" && to.path == "/preview"){
          beforeTo = to;
          beforeFrom = from;
          this.$router.push({name: to.name, query: { doc_id: this.$router.query.doc_id }}).catch(err => {});
        }
        if(from.path == "/preview" && (to.path == "/login" || to.path == "/")){
          beforeTo = to;
          beforeFrom = from;
          this.$router.push({name: to.name}).catch(err => {});
        }
      }
		})
  },
  methods: {
    sendmail() {
      var body = this.doc_info["business_partner_company_name"] +
                 this.doc_info["honorific_title"] + 
                 "%0D%0A%0D%0A平素は大変お世話になっております。%0D%0Aお見積りを送付申し上げます。%0D%0Aどうぞよろしくお願いいたします。%0D%0A%0D%0Aクェスタ株式会社　担当　" +
                 this.user[0]["name"]
      location.href = "mailto:info@example.com?body=" + body
    },

    async submit() {
      this.doc_info.quotation_expiration_date = this.doc_info["quotation_expiration_date"].replace("見積もり有効期限", "");
      axios.post("/api/document", {
        doc_info: this.doc_info,
        product_item: this.product_item,
        postage_item: this.postage_item,
        remarks: this.doc_info["remarks"]
      }).then(res => {
            this.$router.push({
            name: "list"
          })
      });
    },

    onbacklist() {
      if(this.preview_type == 1){
        if(confirm("保存してませんが見積もり一覧に戻りますか?")){
          this.$router.push({
            name: "list"
          });
        }
      }
      else {
        this.$router.push({
              name: "list"
            });
      }
    },

    editbutton() {
      if(this.preview_type == 1){
        this.$router.push({
            name: "form",
            params: {
              doc_info: this.$route.params.doc_info,
              product_item: this.$route.params.product_item,
              postage_item: this.$route.params.postage_item,
              remarks: this.$route.params.remarks
            }
        });
      }
      else if(this.preview_type == 0){
        this.$router.push({
          name: "form",
          params: {
            doc_id: this.$route.query.doc_id
          }
        })
      }
    },

    async getInfo() {
      if(this.$route.params.doc_info){
        this.preview_type = 1
        this.doc_info = this.$route.params.doc_info;
        this.postage_item = this.$route.params.postage_item;
        this.product_item = this.$route.params.product_item;
        this.doc_info["remarks"] = this.$route.params.remarks;
        this.doc_info["quotation_expiration_date"] = "見積もり有効期限" + this.doc_info["quotation_expiration_date"]
        if (this.doc_info["document_type_id"] == 1) {
          this.doc_type_in_txt = "お見積り";
          this.doc_info["document_type_label"] = "見積書";
        } else if (this.doc_info["document_type_id"] == 2) {
          this.doc_type_in_txt = "納品";
          this.doc_info["document_type_label"] = "納品書";
        } else if (this.doc_info["document_type_id"] == 3) {
          this.doc_type_in_txt = "請求";
          this.doc_info["document_type_label"] = "請求書";
        } else if (this.doc_info["document_type_id"] == 4) {
          this.doc_type_in_txt = "領収";
          this.doc_info["document_type_label"] = "領収書";
        }
      }
      else {
        var doc_id = this.$route.query.doc_id;
        await axios
          .get("/api/get-doc-info", { params: { id: doc_id } })
          .then(res => {
            this.doc_info = res.data[0];
            if(this.doc_info["remarks"]){
              this.doc_info["remarks"] = this.doc_info["remarks"].replace(/\r?\n/g,"")
            }
            this.doc_info["quotation_expiration_date"] = "見積もり有効期限" + this.doc_info["quotation_expiration_date"]
          });
        await axios.get("/api/purchasedpostage/" + doc_id).then(res => {
          this.postage_item = res.data;
        });
        await axios.get("/api/purchasedproduct/" + doc_id).then(res => {
          this.product_item = res.data;
          if (this.doc_info["document_type_id"] == 1) {
            this.doc_type_in_txt = "お見積もり";
          } else if (this.doc_info["document_type_id"] == 2) {
            this.doc_type_in_txt = "納品";
          } else if (this.doc_info["document_type_id"] == 3) {
            this.doc_type_in_txt = "請求";
          } else if (this.doc_info["document_type_id"] == 4) {
            this.doc_type_in_txt = "領収";
          }
        });
      }
      this.createTableData();
      this.getUser();
    },

    getUser: function(){
      axios.get("/api/user/"+this.doc_info["user_id"]).then(res=>{
        this.user = res.data;
        this.makePDF();
      });
    },

    createTableData() {
      var tableHeader = [
        {
          text: "商品・品名",
          style: "filledHeader"
        },
        { text: "数量", style: "filledHeader" },
        { text: "単位", style: "filledHeader" },
        { text: "単価", style: "filledHeader" },
        { text: "金額", style: "filledHeader" }
      ];

      this.tableData.push(tableHeader);

      for (var i = 0; i < this.product_item.length; i++) {
        if(this.product_item[i]["name"] == "")continue;
        var datarow = [];
        datarow.push(this.product_item[i]["name"]);
        datarow.push({"text": this.product_item[i]["number"], alignment: "right"});
        datarow.push(this.product_item[i]["unit"]);
        datarow.push({"text": this.product_item[i]["unit_price"].toLocaleString(), alignment: "right"});
        datarow.push(
          {"text": (this.product_item[i]["unit_price"] * this.product_item[i]["number"]).toLocaleString(), alignment: "right"}
        );
        this.tableData.push(datarow);

        this.total_price +=
          this.product_item[i]["unit_price"] * this.product_item[i]["number"];
        this.total_tax +=
          this.product_item[i]["unit_price"] *
          this.product_item[i]["tax"] *
          this.product_item[i]["number"];
        this.doc_info["tax"] = this.product_item[i]["tax"];
      }
      for (var i = 0; i < this.postage_item.length; i++) {
        if(this.postage_item[i]["sender_place"] == "")continue;
        var datarow = [];
        datarow.push(
          this.postage_item[i]["sender_place"] +
            "~" +
            this.postage_item[i]["destination_place"] +
            " " +
            this.postage_item[i]["size"] +
            "サイネージ運送費"
        );
        datarow.push({"text": this.postage_item[i]["number"], alignment: "right"});
        // datarow.push(this.postage_item[i]["unit"]);
        datarow.push("個");
        datarow.push({"text": this.postage_item[i]["postage_price"].toLocaleString(), alignment: "right"});
        datarow.push(
          {"text": (this.postage_item[i]["postage_price"] * this.postage_item[i]["number"]).toLocaleString(), alignment: "right"}
        );
        this.tableData.push(datarow);

        this.total_price +=
          this.postage_item[i]["postage_price"] *
          this.postage_item[i]["number"];
        this.total_tax +=
          this.postage_item[i]["postage_price"] *
          this.postage_item[i]["tax"] *
          this.postage_item[i]["number"];
        this.doc_info["tax"] = this.postage_item[i]["tax"];
      }
      for (
        var i = this.product_item.length + this.postage_item.length;
        i < 10;
        i++
      ) {
        var datarow = [];
        for (var j = 0; j < 5; j++) {
          datarow.push("");
        }
        this.tableData.push(datarow);
      }
      this.tableData.push([
        {
          text: "",
          border: [false, true, false, false]
        },
        {
          text: "",
          border: [false, true, false, false]
        },
        { text: "小計", colSpan: 2 },
        { text: "" },
        { text: Math.floor(this.total_price).toLocaleString(), alignment: "right" }
      ]);
      this.tableData.push([
        {
          text: "",
          border: [false, false, false, false]
        },
        {
          text: "",
          border: [false, false, false, false]
        },
        { text: "消費税(" + this.doc_info["tax"] * 100 + "%)", colSpan: 2 },
        { text: "" },
        { text: Math.floor(this.total_tax).toLocaleString(), alignment: "right" }
      ]);
      this.tableData.push([
        {
          text: "",
          border: [false, false, false, false]
        },
        {
          text: "",
          border: [false, false, false, false]
        },
        { text: "合計金額", colSpan: 2 },
        { text: "" },

        { text: Math.floor(this.total_price + this.total_tax).toLocaleString(), alignment: "right" }
      ]);
    },
    async makePDF() {
      await axios.get("/api/get-base64-img", { params: {img_path: this.doc_info["logo_img_path"]} })
      .then(res => {
        this.company_logo_base64 = res.data;
      });
      pdfMake.fonts = {
        GenShin: {
          normal: "GenShinGothic-Normal-Sub.ttf",
          bold: "GenShinGothic-Normal-Sub.ttf",
          italics: "GenShinGothic-Normal-Sub.ttf",
          bolditalics: "GenShinGothic-Normal-Sub.ttf"
        }
      };
      const defaultStyle = "GenShin";

      // PDF出力する内容の定義
      const docDefinition = {
        content: [
          {
            columns: [
              {
                text: moment(this.doc_info["created_at"]).format(
                  "YYYY年 MMMM Do"
                ),
                alignment: "left",
                fontSize: 15
              },
              {
                text: this.doc_info["document_type_label"],
                alignment: "right",
                fontSize: 18
              }
            ]
          },
          {
            canvas: [
              {
                type: "line",
                x1: 0,
                y1: 1,
                x2: 595 - 2 * 40,
                y2: 1,
                lineWidth: 1
              }
            ]
          },
          {
            text: "No. " + this.doc_info["sell_part_label"] + this.doc_info["see_part_label"] + this.doc_info["customer_part_label"] + ('0000' + this.doc_info["id"]).slice(-4),
            fontSize: 13,
            absolutePosition: { x: 475, y: 65 }
          },
          {
            columns: [
              {
                stack: [
                  {
                    text: this.doc_info["business_partner_company_name"],
                    width: "50%",
                    fontSize: 15,
                    margin: [0, 25, 0, 5]
                  },
                  {
                    text: this.doc_info["honorific_title"],
                    fontSize: 15,
                    absolutePosition: { x: 255, y: 95 }
                  }
                ]
              }
              // {
              //   text: this.doc_info.users.name,
              //   width: "50%",
              //   alignment: "right",
              //   margin: [0, 30, 0, 0],
              //   fontSize: 14
              // }
            ]
          },
          // {
          //   canvas: [
          //     {
          //       type: "line",
          //       x1: (595 - 2 * 40) / 2 + 60,
          //       y1: 0,
          //       x2: 595 - 2 * 40,
          //       y2: 0,
          //       lineWidth: 1
          //     }
          //   ]
          // },
          {
            canvas: [
              {
                type: "line",
                x1: 0,
                y1: 5,
                x2: (595 - 2 * 40) / 2,
                y2: 5,
                lineWidth: 1
              }
            ]
          },
          {
            canvas: [
              {
                type: "line",
                x1: 0,
                y1: 3,
                x2: (595 - 2 * 40) / 2,
                y2: 3,
                lineWidth: 1
              }
            ]
          },
          {
            text:
              "平素は格別のお引き立てを賜り厚く御礼申し上げます。\n下記の通り" +
              this.doc_type_in_txt +
              "申し上げます。\n何卒宜しくお願い申し上げます。",
            width: "50%",
            fontSize: 9,
            margin: [0, 10, 0, 0]
          },
          {
            columns: [
              {
                stack: [
                  {
                    text: "件  名 : " + this.doc_info["document_title"],
                    width: "50%",
                    fontSize: 11,
                    margin: [0, 10, 0, 0]
                  },
                  {
                    margin: [0, 0, 0, 3],
                    canvas: [
                      {
                        type: "line",
                        x1: 0,
                        y1: 2,
                        x2: (595 - 2 * 40) / 2 - 20,
                        y2: 2,
                        lineWidth: 1
                      }
                    ]
                  },
                  {
                    text: "お支払条件 : " + (this.doc_info["payment_terms"] == null ? " " : this.doc_info["payment_terms"]),
                    width: "50%",
                    fontSize: 11
                  },
                  {
                    margin: [0, 0, 0, 3],
                    canvas: [
                      {
                        type: "line",
                        x1: 0,
                        y1: 2,
                        x2: (595 - 2 * 40) / 2 - 20,
                        y2: 2,
                        lineWidth: 1
                      }
                    ]
                  },
                  {
                    text: "利用期間 : " + (this.doc_info["usage_period"] == null ? " " : this.doc_info["usage_period"]),
                    width: "50%",
                    fontSize: 11
                  },
                  {
                    margin: [0, 0, 0, 3],
                    canvas: [
                      {
                        type: "line",
                        x1: 0,
                        y1: 2,
                        x2: (595 - 2 * 40) / 2 - 20,
                        y2: 2,
                        lineWidth: 1
                      }
                    ]
                  },
                  {
                    text: "契約条件 : " + (this.doc_info["term_and_conditions"] == null ? " " : this.doc_info["term_and_conditions"]),
                    width: "50%",
                    fontSize: 11
                  },
                  {
                    margin: [0, 0, 0, 3],
                    canvas: [
                      {
                        type: "line",
                        x1: 0,
                        y1: 2,
                        x2: (595 - 2 * 40) / 2 - 20,
                        y2: 2,
                        lineWidth: 1
                      }
                    ]
                  },
                  {
                    text: "要求仕様 : 別途打ち合わせによる",
                    width: "50%",
                    fontSize: 11
                  },
                  {
                    margin: [0, 0, 0, 3],
                    canvas: [
                      {
                        type: "line",
                        x1: 0,
                        y1: 2,
                        x2: (595 - 2 * 40) / 2 - 20,
                        y2: 2,
                        lineWidth: 1
                      }
                    ]
                  }
                ]
              },
              {
                stack: [
                  {
                    image: "data:image/png;base64," + this.company_logo_base64,
                    width: 200,
                    // height: '*',
                    absolutePosition: { x: 360, y: 100 }
                  },
                  {
                    text: this.doc_info.users.name,
                    width: "50%",
                    // alignment: "right",
                    // margin: [0, 30, 30, 0],
                    absolutePosition: { x: 373, y: 215 },
                    fontSize: 14
                  }
                ]
              }
            ]
          },
          {
            margin: [0, 10, (595 - 2 * 40) / 2, 0],
            table: {
              widths: ["40%", "50%"],
              body: [
                [
                  {
                    text: "金額",
                    style: "filledHeader"
                  },
                  { text: "¥"+Math.floor(this.total_price + this.total_tax).toLocaleString(), alignment: "right" }
                ]
              ],
              defaultStyle: {
                font: defaultStyle
              },
              styles: {
                filledHeader: {
                  bold: true,
                  fontSize: 14,
                  color: "black",
                  fillColor: "lightgrey",
                  alignment: "center"
                }
              }
            }
          },
          {
            margin: [0, 20, 0, 0],
            table: {
              headerRows: 1,
              widths: ["58%", "7%", "7%", "13%", "*"],
              heights: 20,
              body: this.tableData
            }
          },
          { text: "備考", margin: [0, 20, 0, 0] },
          {
            table: {
              widths: ["100%"],
              heights: [70],
              body: [[{ text: this.doc_info["remarks"] }]]
            }
          }
        ],
        defaultStyle: {
          font: defaultStyle
        },
        styles: {
          filledHeader: {
            bold: true,
            fontSize: 14,
            color: "black",
            fillColor: "lightgrey",
            alignment: "center"
          }
        }
      };

      if(this.doc_info["document_type_id"] == 1){
        docDefinition["content"][7]["columns"][0]["stack"].push({
                    text: "見積もり有効期限" + this.doc_info["quotation_expiration_date"].replace("見積もり有効期限", ""),
                    width: "50%",
                    fontSize: 11
                  });
        docDefinition["content"][7]["columns"][0]["stack"].push({
                    margin: [0, 0, 0, 3],
                    canvas: [
                      {
                        type: "line",
                        x1: 0,
                        y1: 2,
                        x2: (595 - 2 * 40) / 2 - 20,
                        y2: 2,
                        lineWidth: 1
                      }
                    ]
                  });
      }

      // pdfMakeでのPDF出力
      this.pdfDocGenerator = pdfMake.createPdf(docDefinition);
      this.pdfDocGenerator.getDataUrl(dataUrl => {
        this.pdffile_path = dataUrl;
      });
    },
    downloadPDF() {
      this.pdfDocGenerator.download();
    }
  }
};
</script>

<style>
a {
  text-decoration: none;
}
</style>
