CREATE TABLE [dbo].[Books](
	[BookID] [int] IDENTITY(1,1) NOT NULL,
	[Title] [varchar](60) NOT NULL,
	[ISBN] [char](13) NOT NULL,
	[Price] [decimal](10, 2) NULL