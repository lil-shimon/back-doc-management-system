<template>
  <div class="content-wrapper is-add_style">
    <div class="main_content p-top">
      <div class="is-body_content">
        <h1 class="is-body_content__title">新規登録</h1>
        <div class="is-body_content__main">
          <div class="p-top__title">
            <h2>{{ today }}</h2>
            <div class="o-form">
              <p class="is-num">No. {{ No }}</p>
              <div style="display: inline-block">
              <div class="flag_text" v-if="doc_info_flag['sell_part_id_flag'] == 1">売識を選択してください</div>
              <select v-model="doc_info['sell_part_id']" style="width: 60px">
                <option value style="display: none;">売識</option>
                <option value="1">S</option>
                <option value="2">R</option>
              </select>
              </div>
              <div style="display: inline-block">
              <div class="flag_text" v-if="doc_info_flag['see_part_id_flag'] == 1">見識を選択してください</div>
              <select v-model="doc_info['see_part_id']" style="width: 60px">
                <option value style="display: none;">見識</option>
                <option value="1">F</option>
                <option value="2">A</option>
                <option value="3">K</option>
                <option value="4">J</option>
                <option value="5">C</option>
              </select>
              </div>
              <div style="display: inline-block">
              <div class="flag_text" v-if="doc_info_flag['customer_part_id_flag'] == 1">客識を選択してください</div>
              <select v-model="doc_info['customer_part_id']" style="width: 60px">
                <option value style="display: none;">客識</option>
                <option value="1">G</option>
                <option value="2">A</option>
                <option value="3">R</option>
              </select>
              </div>
              <div style="display: inline-block">
              <div class="flag_text" v-if="doc_info_flag['document_type_id_flag'] == 1">書類の種類を選択してください</div>
              <select v-model="doc_info['document_type_id']">
                <option value style="display: none;">書類の種類</option>
                <option value="1">お見積り</option>
                <option value="2">納品書</option>
                <option value="3">請求書</option>
                <option value="4">領収書</option>
              </select>
              </div>
            </div>
          </div>
          <div class="p-top__data">
            <dl>
              <dt>
                <div
                  class="flag_text"
                  v-if="doc_info_flag['business_partner_company_name_flag'] == 1"
                >取引先名を入力してください</div>
                <div class="flag_text" v-if="doc_info_flag['honorific_title_flag'] == 1">敬称を選択してください</div>
                <div class="o-form">
                  <!-- <input
                    type="text"
                    name
                    placeholder="取引先名"
                    v-model="doc_info['business_partner_company_name']"
                    id="ccompany"
                  /> -->
                  <input
                    type="text"
                    name
                    placeholder="取引先名"
                    v-model="doc_info['business_partner_company_name']"
                    list="dccompany"
                  />
                  <datalist id="dccompany">
                    <option v-for="(name, index) in contractedcompany_name" :key="index" :value="name['name']"></option>
                  </datalist>
                  <select v-model="doc_info['honorific_title']">
                    <option value style="display: none;">敬称</option>
                    <option value="御中">御中</option>
                    <option value="様">様</option>
                    <option value="殿">殿</option>
                  </select>
                </div>
                <div class="p-top__data__box">
                  <p>平素は格別のお引き立てを賜り厚く御礼申し上げます。</p>
                  <p>
                    下記の通り
                    <span v-if="doc_info['document_type_id'] == 1">お見積り</span>
                    <span v-if="doc_info['document_type_id'] == 2">納品</span>
                    <span v-if="doc_info['document_type_id'] == 3">請求</span>
                    <span v-if="doc_info['document_type_id'] == 4">領収</span>
                    申し上げます。
                  </p>
                  <p>何卒宜しくお願い申し上げます。</p>
                </div>
              </dt>
              <dd>
                <div class="o-form">
                  <div class="flag_text" v-if="doc_info_flag['user_id_flag'] == 1">担当者を選択してください</div>
                  <select v-model="doc_info['user_id']">
                    <option value style="display: none;">担当者</option>
                    <option
                      v-for="item in user_items"
                      :key="item.id"
                      :value="item.id"
                    >{{ item.name }}</option>
                  </select>
                </div>
                <div class="o-form">
                  <div
                    class="flag_text"
                    v-if="doc_info_flag['logo_img_path_flag'] == 1"
                  >会社ロゴを選択してください</div>
                  <select v-model="doc_info['logo_img_path']">
                    <option value style="display: none;">会社ロゴ</option>
                    <option
                      v-for="item in company_logo_items"
                      :key="item.id"
                      :value="item.img_path"
                    >{{ item.name }}</option>
                  </select>
                </div>
                <div class="p-top__data__img">
                  <img :src="'storage/' + doc_info['logo_img_path']" alt />
                </div>
              </dd>
            </dl>
            <div class="p-top__data__input">
              <div class="o-form">
                <div class="flag_text" v-if="doc_info_flag['document_title_flag'] == 1">タイトルを入力してください</div>
                <input type="text" name value placeholder="件名" v-model="doc_info['document_title']" />
                <div class="flag_text" v-if="doc_info_flag['payment_terms_flag'] == 1">お支払い条件を入力してください</div>
                <input
                  type="text"
                  name
                  value
                  placeholder="お支払い条件"
                  v-model="doc_info['payment_terms']"
                />
                <!-- <input type="text" name value placeholder="利用期間" v-model="doc_info['usage_period']" /> -->
                <div class="flag_text" v-if="doc_info_flag['usage_period_start_flag'] == 1">開始日を入力してください</div>
                <Datepicker :language="ja" :calendar-button="true" :calendar-button-icon="'fa fa-calendar'" :format="'yyyy年 MMM d日'" placeholder="利用開始日" v-model="doc_info['usage_period_start']"></Datepicker>
                <div class="flag_text" v-if="doc_info_flag['usage_period_end_flag'] == 1">終了日を入力してください</div>
                <Datepicker :language="ja" :calendar-button="true" :calendar-button-icon="'fa fa-calendar'" :format="'yyyy年 MMM d日'" placeholder="利用終了日" v-model="doc_info['usage_period_end']"></Datepicker>
                <div class="flag_text" v-if="doc_info_flag['term_and_conditions_flag'] == 1">契約条件を入力してください</div>
                <input
                  type="text"
                  name
                  value
                  placeholder="契約条件"
                  v-model="doc_info['term_and_conditions']"
                />
                <input type="text" name value placeholder="見積もり有効期限" v-if="doc_info['document_type_id'] == 1" v-model="doc_info['quotation_expiration_date']"/>
              </div>
            </div>
          </div>
          <div class="p-top__price">
            <ul>
              <li class="is-main">金額</li>
              <li style="text-align:right; padding: 0 10px 0 0">{{ Math.floor(price + tax).toLocaleString() }}</li>
            </ul>
          </div>
          <div class="p-top__table">
            <p class="is-add">単位（円） 消費税別途</p>
            <div class="o-table is-top">
              <table>
                <tr>
                  <th class="is-long">適用</th>
                  <th width="90">数量</th>
                  <th width="90">単位</th>
                  <th>単価</th>
                  <th width="110">金額</th>
                  <th width="60">削除</th>
                </tr>
                <tr v-for="(item, index) in product_items" :key="index">
                  <td class="is-long">
                    <div class="o-form">
                      <input type="text" autocomplete="off" :id="'product-'+index" v-model="product_items[index]['name']" ref="product" list="product">
                      <datalist id="product">
                        <option v-for="(name, index) in product_name" :key="index" :value="name['name']"></option>
                      </datalist>
                    </div>
                  </td>
                  <td>
                    <div class="o-form">
                      <input type="number" name placeholder v-model="product_items[index]['number']" style="text-align:right;"/>
                    </div>
                  </td>
                  <td>
                    <div class="o-form">
                      <select v-model="product_items[index]['unit']">
                        <option value>-</option>
                        <option value="式">式</option>
                        <option value="ヶ月">ヶ月</option>
                        <option value="個">個</option>
                        <option value="枚">枚</option>
                      </select>
                    </div>
                  </td>
                  <td>
                    <div class="o-form">
                      <!-- <input
                        type="number"
                        name
                        placeholder
                        v-model="product_items[index]['unit_price']"
                        style="text-align:right;"
                      /> -->
                      <currency-input 
                        locale="ja" 
                        :currency="null"
                        :precision=0
                        v-model="product_items[index]['unit_price']" 
                        style="text-align:right;">
                      </currency-input>
                    </div>
                  <!-- </td>
                  <td>
                    <div class="o-form">
                      <select v-model="product_items[index]['tax']">
                        <option value>-</option>
                        <option value="0.1">10%</option>
                        <option value="0.08">8%</option>
                        <option value="0.05">5%</option>
                        <option value="0">対象外</option>
                      </select>
                    </div>
                  </td> -->
                  <td>
                    <div class="o-form" style="text-align:right;">
                      {{ (item.unit_price * item.number).toLocaleString() }}
                    </div>
                  </td>
                  <td>
                    <button type="button" class="o-btn is-icon" v-on:click="delete_item(1, index)">
                      <i class="icon is-trash"></i>
                    </button>
                  </td>
                </tr>
              </table>
            </div>
            <div class="o-table__btn" v-on:click="add_row(1)">
              <button type="button" class="o-btn is-grey">追加</button>
            </div>
            <div class="o-table is-top">
              <table>
                <tr>
                  <th width="160">送付元</th>
                  <th width="160">送付先</th>
                  <th width="160">送付サイズ</th>
                  <th width="120">送料</th>
                  <th>送付個数</th>
                  <th class="is-price">金額</th>
                  <th width="60">削除</th>
                </tr>
                <tr v-for="(item, index) in postage_items" :key="index">
                  <td class="is-send">
                    <div class="o-form">
                      <input type="text" autocomplete="off" :id="'sender_place-'+index" v-model="postage_items[index]['sender_place']" ref="sender" list="sender">
                      <datalist id="sender">
                        <option v-for="(name, index) in sender_place_items" :key="index" :value="name"></option>
                      </datalist>
                      <!-- <ul id="suggestrap" :style="suggeststyle['sender'][index]">
                        <li v-for="(item, index_ul) in sender_place_items" :key="index_ul" style="list-style: none;" v-on:click="selectli('sender', index_ul, index)">{{ item }}</li>
                      </ul> -->
                    </div>
                  </td>
                  <td class="is-send">
                    <div class="o-form">
                      <input type="text" autocomplete="off" :id="'destination_place-'+index" v-model="postage_items[index]['destination_place']" ref="destination" list="destination">
                      <datalist id="destination">
                        <option v-for="(name, index) in destination_place_items" :key="index" :value="name"></option>
                      </datalist>
                    </div>
                  </td>
                  <td class="is-size">
                    <div class="o-form">
                      <input type="text" autocomplete="off" :id="'size-'+index" v-model="postage_items[index]['size']" ref="size" list="size">
                      <datalist id="size">
                        <option v-for="(name, index) in size_items" :key="index" :value="name"></option>
                      </datalist>
                    </div>
                  </td>
                  <td>
                    <div class="o-form">
                      <!-- <input
                        type="number"
                        name
                        placeholder
                        v-model="postage_items[index]['postage_price']"
                        value="0"
                        style="text-align:right;"
                      /> -->
                      <currency-input 
                        locale="ja" 
                        :currency="null"
                        :precision=0
                        v-model="postage_items[index]['postage_price']" 
                        style="text-align:right;">
                      </currency-input>
                    </div>
                  </td>
                  <td class="is-num">
                    <div class="o-form">
                      <input type="number" name placeholder v-model="postage_items[index]['number']" style="text-align:right;" />
                    </div>
                  </td>
                  <td class="is-price">
                    <div class="o-form" style="text-align:right;">
                      {{ (item.postage_price * item.number).toLocaleString() }}
                    </div>
                  </td>
                  <td>
                    <button type="button" class="o-btn is-icon" v-on:click="delete_item(2, index)">
                      <i class="icon is-trash"></i>
                    </button>
                  </td>
                </tr>
              </table>
            </div>
            <div class="o-table__btn" v-on:click="add_row(2)">
              <button type="button" class="o-btn is-grey">追加</button>
            </div>
          </div>
          <div class="p-top__table_total">
            <table>
              <tr>
                <th width="175">小計</th>
                <th width="175">消費税</th>
                <th width="175">合計</th>
              </tr>
              <tr>
                <td>
                  <div>
                    <span class="money_span">{{ Math.floor(price).toLocaleString() }}</span>
                  </div>
                </td>
                <td>
                  <div class="flag_text" v-if="p_tax_flag == 1">税を選択してください</div>
                  <div class="money_div">
                    <select class="o-form tax_select" v-model="p_tax">
                      <option value>-</option>
                      <option value="0.1">10%</option>
                      <option value="0.08">8%</option>
                      <option value="0.05">5%</option>
                      <option value="0">対象外</option>
                    </select>
                    <span class="money_span" style="padding-top: 6px;">{{ Math.floor(tax).toLocaleString() }}</span>
                  </div>
                </td>
                <td>
                  <div>
                    <span class="money_span">{{ Math.floor(price + tax).toLocaleString() }}</span>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="p-top__add">
            <div class="o-form">
              <div class="o-form__title">備考</div>
              <textarea name placeholder="テキスト入力" v-model="remarks"></textarea>
            </div>
          </div>
        </div>
        <div class="is-body_content__btn">
          <router-link :to="{name: 'list'}" style="color: white"><button type="button" class="o-btn is-grey">キャンセル</button></router-link>
          <button type="button" class="o-btn is-blue_d" v-on:click="submit(0)">プレビュー</button>
          <button type="button" class="o-btn" v-on:click="submit(1)">保存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import Datepicker from 'vuejs-datepicker';
import {ja} from 'vuejs-datepicker/dist/locale';
import Suggestrap from 'suggestrap';
export default {
  components: {
    Suggestrap,
    Datepicker
  },
  data() {
    return {
      ja:ja,
      remarks: "",
      No: "",
      p_tax: "",
      p_tax_flag: 0,
      // suggeststyle: {
      //   "sender": [],
      //   "destination": [],
      //   "size": []
      // },
      // ulstyle:{
      //   "padding-inline-start": 0,
      //   "text-align": "left",
      //   "position": "absolute",
      //   "visibility": "hidden"
      // },
      product_items: [
        {
          name: "",
          number: 0,
          unit: "",
          unit_price: 0,
          tax: null
        },
        {
          name: "",
          number: 0,
          unit: "",
          unit_price: 0,
          tax: null
        },
        {
          name: "",
          number: 0,
          unit: "",
          unit_price: 0,
          tax: null
        }
      ],
      postage_items: [
        {
          sender_place: "",
          destination_place: "",
          postage_price: 0,
          size: "",
          number: 0,
          tax: null
        },
        {
          sender_place: "",
          destination_place: "",
          postage_price: 0,
          size: "",
          number: 0,
          tax: null
        }
      ],
      postage_data: [],
      sender_place_items: [],
      destination_place_items: [],
      size_items: [],

      product_data: [],
      product_name_items:[],

      sub_items: [{ price: 0, tax: 0, total_price: 0 }],

      user_items: [],
      doc_info: {
        sell_part_id: "",
        see_part_id: "",
        customer_part_id: "",
        document_type_id: "",
        business_partner_company_name: "",
        honorific_title: "",
        user_id: "",
        logo_img_path: "",
        document_title: "",
        payment_terms: "",
        usage_period_start: "",
        usage_period_end: "",
        term_and_conditions: "",
        quotation_expiration_date: "見積もり有効期限60日"
      },
      company_logo_items: [],

      doc_info_flag: {
        sell_part_id_flag: 0,
        see_part_id_flag: 0,
        customer_part_id_flag: 0,
        document_type_id_flag: 0,
        business_partner_company_name_flag: 0,
        honorific_title_flag: 0,
        user_id_flag: 0,
        logo_img_path_flag: 0,
        document_title_flag: 0,
        payment_terms_flag: 0,
        usage_period_start_flag: 0,
        usage_period_end_flag: 0,
        term_and_conditions_flag: 0
      },

      purchasedproduct_items: [],
      purchasedpostage_items: [],

      sender: [],
      destination: [],
      size: [],
      product_name: [],

      contractedcompany: [],
      contractedcompany_name: []
    };
  },
  computed: {
    price() {
      var price = 0;
      for (var i = 0; i < this.product_items.length; i++) {
        price +=
          this.product_items[i]["unit_price"] * this.product_items[i]["number"];
      }
      for (var i = 0; i < this.postage_items.length; i++) {
        price +=
          this.postage_items[i]["postage_price"] *
          this.postage_items[i]["number"];
      }
      return price;
    },

    tax() {
      var tax = 0;
      for (var i = 0; i < this.product_items.length; i++) {
        tax +=
          this.product_items[i]["unit_price"] *
          this.product_items[i]["number"] *
          this.p_tax;
      }
      for (var i = 0; i < this.postage_items.length; i++) {
        tax +=
          this.postage_items[i]["postage_price"] *
          this.postage_items[i]["number"] *
          this.p_tax;
      }
      return tax;
    },

    today() {
      return moment(new Date()).format("YYYY年MM月DD日");
    }
  },
  mounted: function() {
    this.getlogoItems();
    this.get_No();
    this.getUser();
    this.$nextTick(function () {
      this.getPostage();
      this.getProduct();
      this.getCompany();
    })
    this.getInfo();
    this.$router.afterEach((to, from) => {
      console.log("before", beforeTo.path, beforeFrom.path);
      console.log("now", to.path, from.path);
      if((beforeTo.path == to.path) && (beforeFrom.path == from.path)){
        console.log("return");
        return;
      }
      else{
        if(from.path == "/create-doc" && this.editcheck() && to.path != "/preview"){
        // if(from.path == "/create-doc" && to.path != "/preview"){
          beforeTo = to;
          beforeFrom = from;
          window.confirm("保存してませんがこのページを離れますか？") ? this.$router.push({name: to.name}).catch(err => {}) : this.$router.push({name: from.name, params: { 
                doc_info: this.$route.params.doc_info,
                product_item: this.$route.params.product_item,
                postage_item: this.$route.params.postage_item,
                remarks: this.$route.params.remarks }});
        }
        if(from.path == "/create-doc" && to.path == "/preview"){
          beforeTo = to;
          beforeFrom = from;
          this.$router.push({name: to.name, query: { doc_id: this.$router.query.doc_id }}).catch(err => {});
        }

        if(from.path == "/create-doc" && (to.path == "/login" || to.path == "/")){
          beforeTo = to;
          beforeFrom = from;
          this.$router.push({name: to.name}).catch(err => {});
        }
      }
		})
  },
  methods: {
    editcheck(){
      for (let info_key in this.doc_info) {
        if(info_key == "logo_img_path" || info_key == "quotation_expiration_date")continue;
        if(this.doc_info[info_key] != "")return 1
      }
      return 0
    },

    async getCompany(){
      const _sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
      var name = []
      await axios.get("/api/contractedcompany").then(res => {
        this.contractedcompany = res.data;
        for(var i = 0; i < res.data.length; i++){
          name.push(res.data[i]["name"]);
        }
        name = Array.from(new Set(name));
        for(var i = 0; i < name.length; i++){
          this.contractedcompany_name.push({"id":i+1 ,"name":name[i]});
        }
        // await _sleep(1000);
        // new Suggestrap({
        //   target: "ccompany",
        //   key: "name",
        //   values: this.contractedcompany_name
        // },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
      })
    },

    selectli(kind, indli, ind) {
      console.log("onclick")
      if(kind == "sender"){
        this.postage_items[ind]["sender_place"] = this.sender_place_items[indli];
      }
    },

    showlist(kind, ind, isshow) {
      console.log(ind);
      if(isshow == 1 && this.$refs[kind][ind].value == ""){
        this.suggeststyle[kind][ind]["visibility"] = "visible"
      }
      else if(isshow == 0){
        this.suggeststyle[kind][ind]["visibility"] = "hidden"
      }
      console.log(this.suggeststyle[kind][ind]["visibility"]);
    },

    getlogoItems() {
      axios.get("/api/company-logo").then(res => {
        this.company_logo_items = res.data;
        this.doc_info["logo_img_path"] = res.data[0]["img_path"];
      });
    },

    async add_row(table_id) {
      const _sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
      if (table_id == 1) {
        this.product_items.push({
          name: "",
          number: 0,
          unit: "",
          unit_price: 0,
          tax: null
        });
        // await _sleep(1000);
        // new Suggestrap({
        //   target: "product-"+(this.product_items.length-1),
        //   key: "name",
        //   values: this.product_name
        // },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
      }
      if (table_id == 2) {
        this.postage_items.push({
          sender_place: "",
          destination_place: "",
          postage_price: 0,
          size: "",
          number: 0,
          tax: null
        });
        // await _sleep(1000);
        // new Suggestrap({
        //   target: "sender_place-"+(this.postage_items.length-1),
        //   key: "name",
        //   values: this.sender
        // },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // this.suggeststyle["sender"].push(this.ulstyle)
      
        // new Suggestrap({
        //   target: "destination_place-"+(this.postage_items.length-1),
        //   key: "name",
        //   values: this.destination
        // },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // this.suggeststyle["destination"].push(this.ulstyle)
      
        // new Suggestrap({
        //   target: "size-"+(this.postage_items.length-1),
        //   key: "name",
        //   values: this.size
        // },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // this.suggeststyle["size"].push(this.ulstyle)
      }
    },

    async submit(submit_type) {
      var submit_flag = 0;
      for (let info_key in this.doc_info) {
        if(info_key == "remarks" || info_key == "tax" || info_key == "status" || info_key == "payment_terms" || info_key == "usage_period_start" || info_key == "usage_period_end" || info_key == "term_and_conditions")continue;
        if (this.doc_info[info_key] == "") {
          this.doc_info_flag[info_key + "_flag"] = 1;
          submit_flag = 1;
          console.log(info_key, ":no");
        } else {
          this.doc_info_flag[info_key + "_flag"] = 0;
        }
      }
      if(this.p_tax == ""){
        this.p_tax_flag = 1;
        submit_flag = 1;
        console.log("p_tac:no");
      }
      if (submit_flag == 0) {
        if(this.doc_info["usage_period_start"] != "" && this.doc_info["usage_period_end"] != "")
        {
          this.doc_info.usage_period = moment(this.doc_info["usage_period_start"]).format("YYYY年MM月DD日") + "~" + moment(this.doc_info["usage_period_end"]).format("YYYY年MM月DD日");
        }
        else{
          this.doc_info.usage_period = " ";
        }
        this.doc_info.tax = this.p_tax;
        this.doc_info.quotation_expiration_date = this.doc_info["quotation_expiration_date"].replace("見積もり有効期限", "");
        for(var i = 0; i < this.postage_items.length; i++){
            if(this.postage_items[i]["sender_place"] == ""){
              continue
            }
            this.postage_items[i]["tax"] = this.p_tax;
          }
          for(var i = 0; i < this.product_items.length; i++){
            if(this.product_items[i]["name"] == ""){
              continue
            }
            this.product_items[i]["tax"] = this.p_tax;
          }
        if(submit_type == 0){
          this.$router.push({
            name: "preview",
            params: {
              doc_info: this.doc_info,
              product_item: this.product_items,
              postage_item: this.postage_items,
              remarks: this.remarks
            }
          });
        }
        else if(submit_type == 1){
          console.log(this.No);
          axios.post("/api/document", {
            doc_info: this.doc_info,
            product_item: this.product_items,
            postage_item: this.postage_items,
            remarks: this.remarks
          }).then(res => {
            this.$router.push({
            name: "preview",
            query: { doc_id: this.No }
          });
          });
        }
      }
      else {
        scrollTo(0, 0);
      }
    },

    get_No() {
      axios.get("/api/get-document-lenght").then(res => {
        this.No = res.data + 1;
        this.No = ('0000' + this.No).slice(-4)
      });
    },

    getUser() {
      axios.get("api/user").then(res => {
        this.user_items = res.data;
      });
    },

    getPostage() {
      var sender_place_items = new Set();
      var destination_place_items = new Set();
      var size_items = new Set();
      axios.get("api/postage").then(res => {
        this.postage_data = res.data;
        for (var i = 0; i < this.postage_data.length; i++) {
          sender_place_items.add(this.postage_data[i]["sender_place"]);
          destination_place_items.add(
            this.postage_data[i]["destination_place"]
          );
          size_items.add(this.postage_data[i]["size"]);
        }
        this.sender_place_items = Array.from(sender_place_items);
        this.destination_place_items = Array.from(destination_place_items);
        this.size_items = Array.from(size_items);

        // var sender = []
        for (var i = 0; i < this.sender_place_items.length; i++){
            this.sender.push({id: i+1, name: this.sender_place_items[i]})
        }
        // for(var i = 0; i < 2; i++){
        //   new Suggestrap({
        //     target: "sender_place-"+i,
        //     key: "name",
        //     values: this.sender
        //   },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // this.suggeststyle["sender"].push(this.ulstyle)
        // }
        
        // var destination = []
        for (var i = 0; i < this.destination_place_items.length; i++){
            this.destination.push({id: i+1, name: this.destination_place_items[i]})
        }
        // for(var i = 0; i < 2; i++){
        //   new Suggestrap({
        //     target: "destination_place-"+i,
        //     key: "name",
        //     values: this.destination
        //   },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // this.suggeststyle["destination"].push(this.ulstyle)
        // }

        // var size = []
        for (var i = 0; i < this.size_items.length; i++){
            this.size.push({id: i+1, name: this.size_items[i]})
        }
        // for(var i = 0; i < 2; i++){
        //   new Suggestrap({
        //     target: "size-"+i,
        //     key: "name",
        //     values: this.size
        //   },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // this.suggeststyle["size"].push(this.ulstyle)
        // }
      });
    },

    getProduct() {
      var product_name_items = new Set();
      axios.get("api/product").then(res => {
        this.product_data = res.data;
        for (var i = 0; i < this.product_data.length; i++) {
          product_name_items.add(this.product_data[i]["name"]);
        }
        this.product_name_items = Array.from(product_name_items);
        // var product_name = []
        for (var i = 0; i < this.product_name_items.length; i++){
          this.product_name.push({id: i+1, name: this.product_name_items[i]})
        }
        console.log(this.product_name)
        
        // for(var i = 0; i < 3; i++){
        //   new Suggestrap({
        //     target: "product-"+i,
        //     key: "name",
        //     values: this.product_name
        //   },{
        //   minlength: 1,
        //   delay: 0,
        //   count: 20
        // });
        // }
      });
    },

    delete_item: function(table_id, row_id) {
      if (table_id == 1) {
        this.product_items.splice(row_id, 1);
      } else {
        this.postage_items.splice(row_id, 1);
      }
    },

    async getInfo() {
      if(this.$route.params.doc_id){
        var doc_id = this.$route.params.doc_id;
        await axios
          .get("/api/get-doc-info", { params: { id: doc_id } })
          .then(res => {
            this.doc_info = res.data[0];
            // this.doc_info.usage_period_start = res.data[0]["usage_period"].split("~")[0];
            this.doc_info.usage_period_start = "";
            // console.log(typeof(res.data[0]["usage_period"].split("~")[0]), typeof(this.doc_info.usage_period_start))
            // this.doc_info.usage_period_end = res.data[0]["usage_period"].split("~")[1];
            this.doc_info.usage_period_end = "";
            this.doc_info["quotation_expiration_date"] = "見積もり有効期限" + this.doc_info["quotation_expiration_date"]
          });
        await axios.get("/api/purchasedpostage/" + doc_id).then(res => {
          this.postage_items = res.data;
          for(var i = this.postage_items.length; i < 3; i++){
            this.postage_items.push({
            sender_place: "",
            destination_place: "",
            postage_price: 0,
            size: "",
            number: 0,
            tax: null
          })
          }
          if(this.postage_items.length != 0)this.p_tax = this.postage_items[0]["tax"];
        });
        await axios.get("/api/purchasedproduct/" + doc_id).then(res => {
          this.product_items = res.data;
          for (var i = this.product_items.length; i < 3; i++){
            this.product_items.push({
            name: "",
            number: 0,
            unit: "",
            unit_price: 0,
            tax: null
          })
          }
          if(this.product_items.length != 0)this.p_tax = this.product_items[0]["tax"];
        });
      }
      if(this.$route.params.doc_info) {
        this.doc_info = this.$route.params.doc_info;
        this.postage_items = this.$route.params.postage_item;
        this.product_items = this.$route.params.product_item;
        this.remarks = this.$route.params.remarks;
        if(this.product_items.length != 0)this.p_tax = this.product_items[0]["tax"];
        else if(this.postage_items.length != 0)this.p_tax = this.postage_items[0]["tax"];
        for(var i = this.product_items.length; i < 3; i++){
          this.add_row(1);
        }
        for(var i = this.postage_items.length; i < 3; i++){
          this.add_row(2);
        }
      }
    }
  },
  watch: {
    // postage_items: {
    postage_items:{
      handler: async function(newval, oldval) {
        // const _sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
        if (newval.length == oldval.length) {
          // for(var c = 0; c < 5; c++){
          //   await _sleep(100);
            for (var i = 0; i < this.postage_items.length; i++) {
              var sender_match = this.postage_data.filter(
                row => row.sender_place === this.postage_items[i]["sender_place"]
              );
              var destination_match = sender_match.filter(
                row =>
                  row.destination_place ===
                  this.postage_items[i]["destination_place"]
              );
              var size_match = destination_match.filter(
                row => row.size === this.postage_items[i]["size"]
              );
              // try {
              //   this.postage_items[i]["sender_place"] = this.$refs.sender[i].value;
              //   this.postage_items[i]["destination_place"] = this.$refs.destination[i].value;
              //   this.postage_items[i]["size"] = this.$refs.size[i].value;
              // }
              // catch(e) {}
              if (size_match.length != 0) {
                console.log(size_match);
                if(this.postage_items[i]["postage_price"] == size_match[0]["postage_price"] || this.postage_items[i]["postage_price"] == 0){
                  this.postage_items[i]["postage_price"] = size_match[0]["postage_price"];
                }
                // this.postage_items[i]["tax"] = size_match[0]["tax"];
              }
              }
            // if(size_match.length != 0){
            //   break;
            // } 
          // }
        } else {
          this.postage_items = newval;
        }
      },
      deep: true
    },

    product_items: {
      handler: async function(newval, oldval) {
        // const _sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
        if (newval.length == oldval.length) {
          // for(var c = 0; c < 10; c++){
          //   await _sleep(500);
            for (var i = 0; i < this.product_items.length; i++) {
              var product_match = this.product_data.filter(
                row => row.name == this.product_items[i]["name"]
              );
              // try {
              //   this.product_items[i]["name"] = this.$refs.product[i].value;
              // }
              // catch(e){}
              if (product_match.length != 0) {
                console.log(this.product_items[i]["name"], product_match);
                // this.product_items[i]["tax"] = product_match[0]["tax"];
                if(this.product_items[i]["unit_price"] == product_match[0]["unit_price"] || this.product_items[i]["unit_price"] == 0){
                  this.product_items[i]["unit_price"] = product_match[0]["unit_price"];
                }
                if(this.product_items[i]["unit"] == product_match[0]["unit"] || this.product_items[i]["unit"] == ""){
                  this.product_items[i]["unit"] = product_match[0]["unit"];
                }
              }
            }
            // if(product_match.length != 0){
            //   break;
            // } 
          // }
        } else {
          this.product_items = newval;
        }
      },
      deep: true
    }
  }
};
</script>
<style>
.flag_text {
  color: red;
  font-size: 7px;
}

input:focus,
select:focus,
textarea:focus {
	background-color: #d9f6ff;
}

ul[id^="suggestrap"] {
  background: #fff;
  border-radius: 3px;
  box-shadow: -2px 2px 7px rgba(0,0,0,0.3);
  top: auto !important;
  left: auto !important;
}
ul[id^="suggestrap"] li {
  color: #333;
  padding: 1px 6px;
}
ul[id^="suggestrap"] li.suggestrap-active,
ul[id^="suggestrap"] li:hover {
  background: #4b89bf;
  color: #fff;
}

.tax_select {
  width: 55px !important;
  margin-right: 10px;
  float: left;
  text-align: left;
  height: 25px;
}

/* .money_div{} */

.money_span{
  float: right;
  min-height: 0 !important;
}

</style>