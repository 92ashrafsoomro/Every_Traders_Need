export interface ReAuctionOptions {
  page?: number;
  length?: number;
  reg: string;// required
  year?: number | null;
  sort?: "asc" | "desc";
  status?: string;
}