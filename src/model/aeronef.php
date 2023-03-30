<?php

namespace Application\Model\Aeronef;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;
use JetBrains\PhpStorm\Immutable;

class Aeronef
{
    public int $aeronef_id;
    public string $immatriculation;
    public int $SN;
    public float $fh;
    public int $ldgs;
    public float $rh_eng_fh;
    public float $lh_eng_fh;
    public string $commissioning_date;
    public string $decommissioning_date;
    public bool $availability_status;
    public bool $removal_status;
}

class AeronefRepository
{
    public DatabaseConnection $connection;

    public function getAeronefs(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM aeronef"
        );

        $aeronefs = [];

        while (($row = $statement->fetch())) {
            $aeronef = new Aeronef();
            $aeronef->aeronef_id = $row['AERONEF_ID'];
            $aeronef->immatriculation = $row['IMMATRICULATION'];
            $aeronef->SN = $row['S_N'];
            $aeronef->fh = $row['FH'];
            $aeronef->ldgs = $row['LDGS'];
            $aeronef->rh_eng_fh = $row['RH_ENG_FH'];
            $aeronef->lh_eng_fh = $row['LH_ENG_FH'];
            $aeronef->commissioning_date = $row['COMMISSIONING_DATE'];
            $aeronef->availability_status = $row['AVAILABILITY_STATUS'];
            $aeronef->removal_status = $row['REMOVAL_STATUS'];

            $aeronefs[] = $aeronef;
        }

        return $aeronefs;
    }

    public function getActiveAeronefs(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM aeronef WHERE REMOVAL_STATUS = 0"
        );

        $aeronefs = [];

        while (($row = $statement->fetch())) {
            $aeronef = new Aeronef();
            $aeronef->aeronef_id = $row['AERONEF_ID'];
            $aeronef->immatriculation = $row['IMMATRICULATION'];
            $aeronef->SN = $row['S_N'];
            $aeronef->fh = $row['FH'];
            $aeronef->ldgs = $row['LDGS'];
            $aeronef->rh_eng_fh = $row['RH_ENG_FH'];
            $aeronef->lh_eng_fh = $row['LH_ENG_FH'];
            $aeronef->commissioning_date = $row['COMMISSIONING_DATE'];
            $aeronef->availability_status = $row['AVAILABILITY_STATUS'];
            $aeronef->removal_status = $row['REMOVAL_STATUS'];

            $aeronefs[] = $aeronef;
        }

        return $aeronefs;
    }



    public function getAeronef($aeronef_id): ?Aeronef
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM aeronef WHERE AERONEF_ID = ?"
        );

        $statement->execute([$aeronef_id]);

        while (($row = $statement->fetch())) {
            $aeronef = new Aeronef();
            $aeronef->aeronef_id = $row['AERONEF_ID'];
            $aeronef->immatriculation = $row['IMMATRICULATION'];
            $aeronef->SN = $row['S_N'];
            $aeronef->fh = $row['FH'];
            $aeronef->ldgs = $row['LDGS'];
            $aeronef->rh_eng_fh = $row['RH_ENG_FH'];
            $aeronef->lh_eng_fh = $row['LH_ENG_FH'];
            $aeronef->commissioning_date = $row['COMMISSIONING_DATE'];
            $aeronef->availability_status = $row['AVAILABILITY_STATUS'];
            $aeronef->removal_status = $row['REMOVAL_STATUS'];
        }

        return $aeronef;
    }



    public function updateAeronef($aeronef_id, $immatriculation, $SN, $fh, $ldgs, $rh_eng_fh, $lh_eng_fh, $availability): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `aeronef` 
            SET `IMMATRICULATION`= ?,
            `S_N`= ?,
            `FH`= ?,
            `LDGS`= ?,
            `RH_ENG_FH`= ? ,
            `LH_ENG_FH`= ?,
            `AVAILABILITY_STATUS`= ? 
            WHERE `AERONEF_ID`= ? "
        );

        $statement->execute([strtoupper($immatriculation), $SN, $fh, $ldgs, $rh_eng_fh, $lh_eng_fh, $availability, $aeronef_id]);

        $affectedLines = $statement->rowCount();
        if ($affectedLines == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function deletePermanentlyAeronef(int $aeronef_id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM `aeronef`  WHERE `AERONEF_ID`= ? "
        );
        $statement->execute([$aeronef_id]);

        $affectedLines = $statement->rowCount();
        if ($affectedLines == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteApparentlyAeronef(int $aeronef_id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `aeronef` 
            SET `REMOVAL_STATUS`= 1 WHERE `AERONEF_ID`= ? "
        );
        $statement->execute([$aeronef_id]);

        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function addNewAeronef($immatriculation, $sn, $fh, $ldgs, $rh_eng_fh, $lh_eng_fh, $commissioning_date, $availability): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO aeronef(IMMATRICULATION, S_N, FH, LDGS, RH_ENG_FH, LH_ENG_FH, COMMISSIONING_DATE ,AVAILABILITY_STATUS)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $statement->execute([strtoupper($immatriculation), $sn, $fh, $ldgs, $rh_eng_fh, $lh_eng_fh, $commissioning_date, $availability]);
        $affectedLine = $statement->rowCount();
        if ($affectedLine == 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
