#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
create database fredi;
#------------------------------------------------------------
# Table: ligues
#------------------------------------------------------------

CREATE TABLE ligues(
        id_ligue  Int  Auto_increment  NOT NULL ,
        lib_ligue Varchar (100) NOT NULL
	,CONSTRAINT ligues_PK PRIMARY KEY (id_ligue)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: clubs
#------------------------------------------------------------

CREATE TABLE clubs(
        id_club       Int  Auto_increment  NOT NULL ,
        lib_club      Varchar (100) NOT NULL ,
        adresse1_club Varchar (50) NOT NULL ,
        adresse2_club Varchar (50) NOT NULL ,
        adresse3_club Varchar (50) NOT NULL ,
        id_ligue      Int NOT NULL
	,CONSTRAINT clubs_PK PRIMARY KEY (id_club)

	,CONSTRAINT clubs_ligues_FK FOREIGN KEY (id_ligue) REFERENCES ligues(id_ligue)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: periodeFiscale
#------------------------------------------------------------

CREATE TABLE periodeFiscale(
        id_fisc       Int  Auto_increment  NOT NULL ,
        annee_fisc    Year NOT NULL ,
        montant_fisc  Decimal NOT NULL ,
        isactive_fisc Bool NOT NULL
	,CONSTRAINT periodeFiscale_PK PRIMARY KEY (id_fisc)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id_util       Int  Auto_increment  NOT NULL ,
        pseudo_util   Varchar (50) NOT NULL ,
        mdp_util      Varchar (255) NOT NULL ,
        nom_util      Varchar (50) NOT NULL ,
        prenom_util   Varchar (50) NOT NULL ,
        mail_util     Varchar (50) NOT NULL ,
        is_controleur Bool NOT NULL ,
        is_admin      Bool NOT NULL ,
        is_adherant   Bool NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (id_util)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adherant
#------------------------------------------------------------

CREATE TABLE adherant(
        id_adherant Int  Auto_increment  NOT NULL ,
        num_licence Int NOT NULL ,
        adresse1_ad Varchar (150) NOT NULL ,
        adresse2_ad Varchar (150) NOT NULL ,
        adresse3_ad Varchar (150) NOT NULL ,
        id_club     Int NOT NULL ,
        id_util     Int NOT NULL
	,CONSTRAINT adherant_PK PRIMARY KEY (id_adherant)

	,CONSTRAINT adherant_clubs_FK FOREIGN KEY (id_club) REFERENCES clubs(id_club)
	,CONSTRAINT adherant_utilisateur0_FK FOREIGN KEY (id_util) REFERENCES utilisateur(id_util)
	,CONSTRAINT adherant_utilisateur_AK UNIQUE (id_util)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: noteFrais
#------------------------------------------------------------

CREATE TABLE noteFrais(
        id_nfrais   Int  Auto_increment  NOT NULL ,
        isvalid     Bool NOT NULL ,
        tot_nfrais  Decimal NOT NULL ,
        dateOrdre   Date NOT NULL ,
        numOrdre    Int NOT NULL ,
        id_adherant Int NOT NULL ,
        id_fisc     Int NOT NULL
	,CONSTRAINT noteFrais_PK PRIMARY KEY (id_nfrais)

	,CONSTRAINT noteFrais_adherant_FK FOREIGN KEY (id_adherant) REFERENCES adherant(id_adherant)
	,CONSTRAINT noteFrais_periodeFiscale0_FK FOREIGN KEY (id_fisc) REFERENCES periodeFiscale(id_fisc)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: motifDeplacement
#------------------------------------------------------------

CREATE TABLE motifDeplacement(
        id_motif  Int  Auto_increment  NOT NULL ,
        lib_motif Varchar (50) NOT NULL
	,CONSTRAINT motifDeplacement_PK PRIMARY KEY (id_motif)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ligneFrais
#------------------------------------------------------------

CREATE TABLE ligneFrais(
        id_lfrais    Int  Auto_increment  NOT NULL ,
        lib_deplace  Varchar (50) NOT NULL ,
        date_deplace Date NOT NULL ,
        frais_peage  Decimal NOT NULL ,
        frais_repas  Decimal NOT NULL ,
        frais_heber  Decimal NOT NULL ,
        nb_km        Decimal NOT NULL ,
        total_lfrais Decimal NOT NULL ,
        id_nfrais    Int NOT NULL ,
        id_motif     Int NOT NULL
	,CONSTRAINT ligneFrais_PK PRIMARY KEY (id_lfrais)

	,CONSTRAINT ligneFrais_noteFrais_FK FOREIGN KEY (id_nfrais) REFERENCES noteFrais(id_nfrais)
	,CONSTRAINT ligneFrais_motifDeplacement0_FK FOREIGN KEY (id_motif) REFERENCES motifDeplacement(id_motif)
)ENGINE=InnoDB;

