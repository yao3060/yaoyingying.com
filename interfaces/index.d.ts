export interface Post {
  id: number;
  title: {
    rendered: string;
  };
  slug: string;
  status: string;
  type: string;
  link: string;
  content: {
    rendered: string;
  };
  excerpt: {
    rendered: string;
  };
  sticky: boolean;
  template: string;
  format: string;
  data: string;
  x_author: string;
  x_date: string;
  x_categories: string;
  featured_media: number;
  x_featured_media_medium?: string;
}

export interface Category {
  id: number;
  name: string;
  slug: string;
}

export interface Tag {
  id: number;
  name: string;
  slug: string;
  count?: number;
}

export interface Product {
  id: number;
  name: string;
  slug: string;
  date_modified: string;
  type: "variable" | "simple";
  featured: boolean;
  description: string;
  short_description: string;
  sku: string;
  price: string;
  stock_status: string;
  regular_price: string;
  sale_price: string;
  price_html: string;
  categories: {
    id: number;
    name: string;
    slug: string;
  }[];
  images: { id: number; name: string; src: string }[];
  attributes: {
    id: number;
    name: string;
    position: number;
    visible: boolean;
    variation: boolean;
    options: string[];
  }[];
  default_attributes: {
    id: number;
    name: string;
    option: string;
  }[];
}

export interface Variation
  extends Pick<
    Product,
    "id" | "sku" | "price" | "regular_price" | "stock_status"
  > {
  image: Product["images"][0];
  attributes: Product["default_attributes"];
}
